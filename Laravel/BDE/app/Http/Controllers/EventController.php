<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Manifestation;
use App\Participant;
use App\Photo;
use App\Centre;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Manifestation::all();
        return view('evenement', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evenement_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:40',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'prix' => 'required|integer',
            'photo' => 'required|image'
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
            'photo' => $path,
            'centre_id' => '1'
        ]);
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $events = Manifestation::all();
        $nbUser = Participant::where('manifestation_id', $id)->count();
        $photos = Photo::where('manifestation_id', $id)->get();
        $eventSelec = Manifestation::where('id', $id)->first();
        return view('evenement', compact('events', 'eventSelec', 'nbUser', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Manifestation::where('id', $id)->first();
        return view('evenement_edit', compact('id', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image'
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
        $event->photo = $path;
        $event->save();

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = Manifestation::all();
        $participants = Participant::all();
        foreach ($participants as $participant) {
            $participant->where('manifestation_id', $id)->delete();
        }
        $event = Manifestation::where('id', $id)->first();
        File::delete('storage/'.$event->photo);
        $event->delete();
        return redirect()->route('event.index');
    }

    public function registerEvent(Manifestation $eventSelec){
        $events = Manifestation::all();
        Participant::create([
            'user_id' => Auth::user()->id,
            'manifestation_id' => $eventSelec->id
        ]);
        return back();
    }
}
