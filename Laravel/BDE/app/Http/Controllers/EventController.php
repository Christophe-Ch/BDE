<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Manifestation;
use App\Participant;
use App\Photo;

class EventController extends Controller
{
    function index(){
        $events = Manifestation::all();
        return view('evenement', compact('events'));
    }

    function showModal(Manifestation $eventSelec){
        $events = Manifestation::all();
        $nbUser = Participant::where('manifestation_id', $eventSelec->id)->count();
        $photos = Photo::where('manifestation_id', $eventSelec)->get();
        return view('evenement', compact('events', 'eventSelec', 'nbUser', 'photos'));
    }

    function registerEvent(Manifestation $eventSelec){
        $events = Manifestation::all();

        Participant::create([
            'user_id' => Auth::user()->id,
            'manifestation_id' => $eventSelec->id
        ]);

        return back();
    }
}
