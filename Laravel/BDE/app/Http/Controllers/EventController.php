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

class EventController extends Controller
{
    /**
     * Display all event.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Manifestation::all();
        $participants = Participant::all();
        return view('evenement', compact('events','participants'));
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
        $events = Manifestation::all();

        $extension =  $request->file('photo')->extension();
        $path = $request->nom .'.'. $extension;
        Image::make($request->file('photo'))->save(public_path('storage/'.$path));

        Manifestation::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'date' => $request->date,
            'prix' => $request->prix,
            'recurrence' => $request->recurrence,
            'photo' => $path,
            'centre_id' => '1'
        ]);

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
        $events = Manifestation::all();
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

        $events = Manifestation::all();
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
     * Search and return specific event.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function searchEvent(Request $request) {
        //$events = Manifestation::all();
        if($request->input('search') != null) {
            $events = Manifestation::where("nom", 'LIKE', '%' . $request->input('search') . '%')->orWhere("description", 'LIKE', '%' . $request->input('search') . '%')->get();
            dd($events);
            return view('event.index', compact('events'));
        } else {
            return redirect()->route('event.index');
        }
    }

    /**
     * Register a user to an event.
     * 
     * @param \App\Manifestation $eventSelec
     */
    public function registerEvent(Manifestation $eventSelec){
        $events = Manifestation::all();
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
        $events = Manifestation::all();
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
        $events = Manifestation::all();
        $eventSelec->report = 1;
        $eventSelec->save();
        return redirect()->route('event.index');
    }
}
