<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Centre;

class UserController extends Controller
{
    function index(){
        return view('profil');
    }

    function getModifier(User $user){
        $centres = Centre::all();
        return view('profil_modifier', compact('centres'));
    }

    function postModifier(User $user){
        $user->name = request('name');
        $user->prenom = request('prenom');
        $user->email = request('email');
        $user->centre_id = request('centre');
        $user->save();

        return redirect()->route('profil');
    }
}
