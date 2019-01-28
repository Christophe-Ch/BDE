<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Manifestation;
use App\User;
use App\Like;
use App\Commentaire;
use App\Notification;
use App\Participant;
use App\Photo;

class PhotoEventController extends Controller
{
    /**
     * Store a new photo for a event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user() && !Participant::where('manifestation_id',$request->event)->where('user_id',Auth::user()->id)->get()->isEmpty()){
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
        } else {
            return back();
        }
    }

    /**
     * Display a specific photo.
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
     * Remove a specific photo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->statut_id != 2) return back();
        $photo = Photo::where('id', $id)->first();
        $event = $photo->manifestation_id;
        $photo->delete();
        $commentaires = Commentaire::where('photo_id', $id)->get();
        foreach ($commentaires as $commentaire) {
            $commentaire->delete();
        }
        $photoLikes = Like::where('photo_Id', $id)->get();
        foreach ($photoLikes as $photoLike) {
            $photoLike->delete();
        }
        return redirect()->route('event.show', ['event' => $event]);
    }

    /**
     * Signal a photo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function signal($id)
    {
        $users = User::where('statut_id', 2)->get();
        $photo = Photo::find($id)->first();
        $photo->report = 1;
        $photo->save();
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
     * Add a like to a photo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $photoLike = new Like();
        $photoLike->photo_id = $id;
        $photoLike->user_id = Auth::user()->id;
        $photoLike->save();
        
        return back();
    }

    /**
     * Remove a like to a photo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unLike($id)
    {
        $photoLikes = Like::where('photo_Id', $id)->where('user_id', Auth::user()->id)->delete();
        return back();
    }

    /**
     * Add comment to a photo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment($id)
    {
        request()->validate([
            'commentaire' => 'required|max:255',
        ]);
        $commentaire = new Commentaire();
        $commentaire->contenu = request('commentaire');
        $commentaire->date = date('Y-m-d');
        $commentaire->user_id = Auth::user()->id;
        $commentaire->photo_id = $id;
        $commentaire->save();
        
        return back();
    }

    /**
     * Signal a comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function signalerComment($id)
    {
        if(Auth::user()->statut_id != 3) return back();
        $users = User::where('statut_id', 2)->get();
        $commentaire = Commentaire::find($id)->first();
        $commentaire->report = 1;
        $commentaire->save();
        $userSelec = User::find($commentaire->user_id)->first();
        foreach ($users as $user) {
            Notification::create([
                'titre' => 'Commentaire signalé',
                'message' => 'Une commentaire de '.$userSelec->name.' '.$userSelec->prenom.' à été signalé',
                'date' => date('Y-m-d'),
                'url' => '/photoEvent/'.$commentaire->manifestation_id,
                'lue' => 0,
                'user_id' => $user->id,
            ]);
        }
        return back();
    }
    /**
     * Remove a comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyComment($id)
    {
        if(Auth::user()->statut_id != 2) return back();
        Commentaire::find($id)->delete();
        return back();
    }
}
