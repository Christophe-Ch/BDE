<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
