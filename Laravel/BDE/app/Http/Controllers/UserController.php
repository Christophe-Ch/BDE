<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
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
        request()->validate([
            'name' => 'required|max:40',
            'prenom' => 'required|max:40',
            'email' => 'required|email'
        ]);

        $user->name = request('name');
        $user->prenom = request('prenom');
        $user->email = request('email');
        $user->save();

        return redirect()->route('profil');
    }

    function postModifierAvatar(User $user){
        request()->validate([
            'photo' => 'required|image'
        ]);
        $extension =  request()->file('photo')->extension();
        $path = $user->id .'.'. $extension;
        Image::make(request()->file('photo'))->save(public_path('storage/'.$path));

        $user->photo = $path;
        $user->save();

        return back();
    }
}
