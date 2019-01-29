<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
    /**
     * Register a new user
     */
    function register() {
        if(!User::where('email', request('email'))->count()) { // If email address is free
            do { // Generate token
                $api_token = str_random(100); 
            } while(User::where('api_token', $api_token)->count());

            $user = new User();

            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->centre_id = request('centre_id');
            $user->statut_id = 1;
            $user->api_token = str_random(100);

            $user->save();

            return $user;
        }
        else {
            return response("Email already exists", 400);
        }
    }

    /**
     * Update profile
     */
    function updateSelf() {
        $user = User::where('api_token', request('token'))->first(); // Get user with token

        if($user) { // If user exists
            if(request()->has('first_name')) {
                $user->prenom = request('first_name');
            }
    
            if(request()->has('last_name')) {
                $user->name = request('last_name');
            }

            if(request()->has('email') && !User::where('email', request('email'))->count()) {
                $user->email = request('email');
            }

            if(request()->has('password')) {
                $user->password = bcrypt(request('password'));
            }

            $user->save();

            return $user;
        }
        else {
            return response('User not found', 404);
        }
    }

    /**
     * Update user
     */
    function updateUser($id) {
        
        $user = User::find($id);

        if($user) {
            if(request()->has('first_name')) {
                $user->prenom = request('first_name');
            }
    
            if(request()->has('last_name')) {
                $user->name = request('last_name');
            }

            if(request()->has('email') && !User::where('email', request('email'))->count()) {
                $user->email = request('email');
            }

            if(request()->has('password')) {
                $user->password = bcrypt(request('password'));
            }

            $user->save();

            return $user;
        }
        else {
            return response('User not found', 404);
        }
    }

}
