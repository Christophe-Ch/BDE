<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Manifestation;
use App\Participant;
use App\User;
use League\Csv\Reader;

class DownloadController extends Controller
{
    /**
     * Download all images in storage.
     * 
     */
    public function downloadImages(){
        if(Auth::user()->statut_id != 3) return back();
        $this->createZip();
        return response()->download(public_path('allImages.zip'));
    }

    /**
     * Create a zip with all images in storage.
     * 
     */
    private function createZip(){
        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(public_path('storage/*'));
        $zipper->make(public_path('allImages.zip'))->add($files);
    }

    /**
     * Download all participant of an event.
     * 
     * @param int $idEvent
     */
    public function downloadParticipants($idEvent){
        if(Auth::user()->statut_id != 2) return back();
        $event = Manifestation::find($idEvent);
        $participants = Participant::where('manifestation_id', $idEvent)->get();
        $users = [];
        foreach ($participants as $participant) {
            array_push($users, User::find($participant->user_id));
        }
        $list = new \Laracsv\Export();
        $list->build(collect($users), ['email', 'name', 'prenom', 'centre_id']);
        $listString = (string) $list->getCsv();
        $listString = str_replace(',', ';', $listString);
        $csv = Reader::createFromString($listString);
        $csv->output('participants_'.$event->nom.'.csv');
    }
}
