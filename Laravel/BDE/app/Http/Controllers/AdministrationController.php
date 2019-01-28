<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrationController extends Controller
{
    public function index() {
        if(Auth::user()->statut_id != 2)
            return back();

        return view('administration');
    }
}
