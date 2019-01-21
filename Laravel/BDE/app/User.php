<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
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
        return $this->belongsToMany('\App\Article', 'articles', 'user_id', 'quantite');
    }
}
