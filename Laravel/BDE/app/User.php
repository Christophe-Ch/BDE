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

    public function manifestation() {
        return $this->belongsToMany('App\Manifestation');
    }

    public function photo() {
        return $this->belongsToMany('App\Photo');
    }


}
