<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idee;
use App\Vote;

class IdeasController extends Controller
{
    public function index() {
        $ideas = Idee::all();

        return view('ideas/index', compact('ideas', 'nbreVote'));
    }
}
