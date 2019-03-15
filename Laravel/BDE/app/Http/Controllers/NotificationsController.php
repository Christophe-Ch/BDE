<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    /**
     * Display notifications page
     */
    public function index() {
        $notifications = Notification::where("user_id", "=", Auth::user()->id)->get(); // Get user's notifications
        foreach($notifications as $notification) { // Mark those as read
            $notification->lue = true;
            $notification->save();
        }

        return view('notifications', compact('notifications'));
    }

    /**
     * Delete notification
     */
    public function delete(Notification $notification) {
        $notification->delete();
        return back();
    }
}
