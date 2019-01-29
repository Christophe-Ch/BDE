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
    /**
     * Return profil view
     * 
     */
    public function index(){
        return view('profil');
    }

    /**
     * Return view to modify profil
     * 
     */
    public function getModifier(){
        return view('profil_modifier');
    }

    /**
     * Update the profil and redirect to profil view
     * 
     * @param  \App\User  $user
     */
    public function postModifier(User $user){
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


    /**
     * Update the profil avatar
     * 
     * @param  \App\User  $user
     */
    public function postModifierAvatar(User $user){
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
