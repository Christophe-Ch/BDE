<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = false;
    public $remember_token = false;

    public function centre() {
        return $this->belongsTo('App\Centre');
    }

    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    public function idees() {
        return $this->hasMany('\App\Idee');
    }

    public function manifestations() {
        return $this->belongsToMany('App\Manifestation');
    }

    public function photos() {
        return $this->hasMany('App\Photo');
    }

    public function achats() {
        return $this->belongsToMany('\App\Article')->withPivot('quantite');
    }

    public function commentaires() {
        return $this->hasMany('\App\Commentaire');
    }

    public function notifications() {
        return $this->hasMany('App\Notification');
    }

    public function hasNotifications() {
        foreach($this->notifications()->get() as $notification) {
            if ($notification->lue == false) {
                return true;
            }
        }

        return false;
    }
}
