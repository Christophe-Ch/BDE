<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Manifestation;
use App\Commentaire;
use App\Recurrence;
use App\Participant;
use App\Photo;
use App\Centre;
use App\Idee;
use App\Vote;
use App\Like;

class EventController extends Controller
{
    /**
     * Display all event.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();
        return view('evenement', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->statut_id != 2) return back();
        $recurrences = Recurrence::all();
        $ideeId = Input::get('idee');
        $idee = Idee::find($ideeId);
        return view('evenement_add', compact('recurrences', 'idee'));
    }

    /**
     * Store a newly created event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->statut_id != 2) return back();
        $request->validate([
            'nom' => 'required|max:40',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'prix' => 'required|integer',
            'recurrence' => 'required|integer',
            'photo' => 'required|image|max:20480'
        ]);
        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();

        $extension =  $request->file('photo')->extension();
        $path = $request->nom .'.'. $extension;
        Image::make($request->file('photo'))->save(public_path('storage/'.$path));

        if ($request->recurrence == 1) {
            Manifestation::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'date' => $request->date,
                'prix' => $request->prix,
                'recurrence' => $request->recurrence,
                'photo' => $path,
                'centre_id' => env('CENTRE_ID', 1)
            ]);
        } else if($request->recurrence == 2){
            $date = $request->date;
            for ($i=0; $i < 12; $i++) {
                Manifestation::create([
                    'nom' => $request->nom,
                    'description' => $request->description,
                    'date' => $date,
                    'prix' => $request->prix,
                    'recurrence' => $request->recurrence,
                    'photo' => $path,
                    'centre_id' => env('CENTRE_ID', 1)
                ]);
                $date = date('Y-m-d', strtotime('+1 month', strtotime($date)));
            }
        }


        if ($request->ideeId != null) {
            Idee::find($request->ideeId)->delete();
            $ideeLikes = Vote::where('idee_id',$request->ideeId)->get();
            foreach ($ideeLikes as $ideeLike) {
                $ideeLike->delete();
            }
        }

        return redirect()->route('event.index');
    }

    /**
     * Display a specific event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();
        $participants = Participant::all();
        $nbUser = Participant::where('manifestation_id', $id)->count();
        $photos = Photo::where('manifestation_id', $id)->get();
        $eventSelec = Manifestation::where('id', $id)->first();
        return view('evenement', compact('events', 'eventSelec', 'nbUser', 'photos', 'participants'));
    }

    /**
     * Show the form for editing a specific event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->statut_id != 2) return back();
        $recurrences = Recurrence::all();
        $event = Manifestation::where('id', $id)->first();
        return view('evenement_edit', compact('id', 'event', 'recurrences'));
    }

    /**
     * Update the specified event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->statut_id != 2) return back();
        $request->validate([
            'photo' => 'required|image|max:20480'
        ]);
        $extension =  $request->file('photo')->extension();
        $path = $request->nom .'.'. $extension;

        if (File::exists('storage/'.$path)) {
            File::delete('storage/'.$path);
        }
        $extension =  $request->file('photo')->extension();
        $path = $request->nom .'.'. $extension;
        Image::make($request->file('photo'))->save(public_path('storage/'.$path));

        $event = Manifestation::where('id', $id)->first();
        $event->nom = $request->nom;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->prix = $request->prix;
        $event->recurrence = $request->recurrence;
        $event->photo = $path;
        $event->save();

        return redirect()->route('event.index');
    }

    /**
     * Remove the specific event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->statut_id != 2) return back();

        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();
        $participants = Participant::all();
        foreach ($participants as $participant) {
            $participant->where('manifestation_id', $id)->delete();
        }
        $photos = Photo::all();
        foreach ($photos as $photo) {
            $photoA = $photo->where('manifestation_id', $id)->first();
            $commentaires = Commentaire::where('photo_id', $photoA->id)->get();
            foreach ($commentaires as $commentaire) {
                $commentaire->delete();
            }
            $photoLikes = Like::where('photo_Id', $photoA->id)->get();
            foreach ($photoLikes as $photoLike) {
                $photoLike->delete();
            }
            File::delete('storage/'.$photoA->url);
            $photoA->delete();
        }
        $event = Manifestation::where('id', $id)->first();
        File::delete('storage/'.$event->photo);
        $event->delete();
        return redirect()->route('event.index');
    }

    /**
     * Register a user to an event.
     *
     * @param \App\Manifestation $eventSelec
     */
    public function registerEvent(Manifestation $eventSelec){
        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();
        Participant::create([
            'user_id' => Auth::user()->id,
            'manifestation_id' => $eventSelec->id
        ]);
        return back();
    }

    /**
     * Unregister a user to an event.
     *
     * @param \App\Manifestation $eventSelec
     */
    public function unRegisterEvent(Manifestation $eventSelec){
        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();
        Participant::where('manifestation_id',$eventSelec->id)->where('user_id',Auth::user()->id)->delete();
        return redirect()->route('event.index');
    }

    /**
     * Signal an event.
     *
     * @param \App\Manifestation $eventSelec
     */
    public function signalEvent(Manifestation $eventSelec){
        if(Auth::user()->statut_id != 3) return back();
        $currentMonth = date('m');
        $events = Manifestation::whereRaw('MONTH(date) = ?', [$currentMonth])->get();
        $eventSelec->report = 1;
        $eventSelec->save();
        return redirect()->route('event.index');
    }

    /**
     * Search and return specific event.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function searchEvent(Request $request) {
        if($request->input('search') != null) {
            if(Auth::check()) {
                $events = Manifestation::where("nom", 'LIKE', '%' . $request->input('search') . '%')->where("centre_id", Auth::user()->centre_id)->orWhere("description", 'LIKE', '%' . $request->input('search') . '%')->get();
            } else {
                $events = Manifestation::where("nom", 'LIKE', '%' . $request->input('search') . '%')->where("centre_id", env("centre_id", 1))->orWhere("description", 'LIKE', '%' . $request->input('search') . '%')->get();
            }
            return view('evenement', compact('events'));
        } else {
            return redirect()->route('event.index');
        }
    }
}
