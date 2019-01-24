<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Manifestation;
use App\User;
use App\Commentaire;
use App\Notification;
use App\Participant;
use App\Photo;

class PhotoEventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event' => 'required',
            'photo' => 'required|image'
        ]);
        $path = $request->event.'_'.$request->photo->getClientOriginalName();
        Image::make($request->file('photo'))->save(public_path('storage/'.$path));

        Photo::create([
            'url' => $path,
            'manifestation_id' => $request->event,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('event.show', ['event' => $request->event]);
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
        $photoEvent = Photo::where('id', $id)->first();
        $eventPhoto = Manifestation::where('id', $photoEvent->manifestation_id)->first();
        $commentaires = Commentaire::where('photo_id', $photoEvent->id)->get();
        return view('evenement', compact('photoEvent', 'events', 'eventPhoto', 'commentaires'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::where('id', $id)->first();
        $event = $photo->manifestation_id;
        $photo->delete();
        $commentaires = Commentaire::where('photo_id', $id)->get();
        foreach ($commentaires as $commentaire) {
            $commentaire->delete();
        }
        return redirect()->route('event.show', ['event' => $event]);
    }

    /**
     * Signal the photos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function signal($id)
    {
        $users = User::where('statut_id', 2)->get();
        foreach ($users as $user) {
            Notification::create([
                'titre' => 'Photo signalé',
                'message' => 'Une photo à été signalé',
                'date' => date('Y-m-d'),
                'url' => '/photoEvent/'.$id,
                'lue' => 0,
                'user_id' => $user->id,
            ]);
        }
        return back();
    }

    /**
     * Add comment to the photos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment($id)
    {
        $commentaire = new Commentaire();
        $commentaire->contenu = request('commentaire');
        $commentaire->date = date('Y-m-d');
        $commentaire->user_id = Auth::user()->id;
        $commentaire->photo_id = $id;
        $commentaire->save();
        
        return back();
    }
}