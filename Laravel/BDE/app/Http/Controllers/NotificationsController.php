<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index() {
        $notifications = Notification::where("user_id", "=", Auth::user()->id)->get();
        foreach($notifications as $notification) {
            $notification->lue = true;
            $notification->save();
        }

        return view('notifications', compact('notifications'));
    }

    public function delete(Notification $notification) {
        $notification->delete();
        return back();
    }
}
