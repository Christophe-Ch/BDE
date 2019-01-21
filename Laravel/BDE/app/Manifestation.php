<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifestation extends Model
{
    //

    public function centre() {
        return $this->belongsTo('App\Centre');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function photos() {
        return $this->hasMany('App\Photo');
    }
}
