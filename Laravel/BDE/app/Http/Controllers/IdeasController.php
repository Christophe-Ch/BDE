<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Idee;
use App\Vote;

class IdeasController extends Controller
{
    public function index() {
        $ideas = Idee::all();
        $votes = Vote::all();

        return view('ideas/index', compact('ideas', 'votes'));
    }

    public function create() {
        return view('ideas/create');
    }

    public function addVote($id) {
        $vote = new Vote;
        $vote->idee_id = $id;
        $vote->user_id = Auth::user()->id;
        $vote->save();

        return back();
    }

    public function deleteVote($id) {
        Vote::where('user_id', Auth::user()->id)->where('idee_id', $id)->delete();
        return back();
    }
}
