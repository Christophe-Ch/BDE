<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    //

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
