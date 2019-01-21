<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    public function manifestation() {
        return $this->belongsTo('App\Manifestation');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function likes() {
        return $this->belongsToMany('App\User');
    }

    public function commentaires() {
        return $this->hasMany('App\Commentaire');
    }
}
