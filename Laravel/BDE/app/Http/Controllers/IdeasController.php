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

    public function edit($id) {
        $edit = Idee::find($id);

        return view('ideas/edit', compact('edit'));
    }

    public function createIdea(Request $request) {
        $idea = new Idee;
        $idea->nom = $request->input('title');
        $idea->description = $request->input('description');
        $idea->user_id = Auth::user()->id;
        $idea->centre_id = 1;

        $idea->save();

        return redirect('/ideas');
    }

    public function editIdea(Request $request, $id) {
        $idea = Idee::find($id);

        $idea->nom = $request->input('title');
        $idea->description = $request->input('description');

        $idea->save();

        return redirect('/ideas');
    }

    public function deleteIdea($id) {
        $delete = Idee::find($id);
        $delete->delete();

        return back();
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
