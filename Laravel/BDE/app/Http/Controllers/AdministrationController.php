<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class AdministrationController extends Controller
{
    /**
     * Display administration page
     */
    public function index() {
        if(Auth::user()->statut_id != 2) // If user has BDE status
            return back();

        return view('administration');
    }

    /**
     * Display edit page
     */
    public function edit(User $user) {
        if(Auth::user()->statut_id != 2) // If user has BDE status
            return back();

        if(Auth::user()->id == $user->id) { // If user is himself
            return redirect('/profil');
        }

        return view('auth.edit_user', compact('user'));
    }

    /**
     * Update user information
     */
    public function update(User $user) {
        $user->name = request('name');
        $user->prenom = request('prenom');
        $user->email = request('email');
        $user->save();
        return redirect('/administration');
    }
}
