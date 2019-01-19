<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    public function manifestation() {
        return $this->belongsTo('App\Manifestation', 'id_manif');
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function userLike() {
        return $this->belongsToMany('App\User');
    }
}
