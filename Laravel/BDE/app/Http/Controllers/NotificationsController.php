<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index() {
        dd(Notification::where("user_id", "=", Auth::user()->id)->first()->message);
    }
}
