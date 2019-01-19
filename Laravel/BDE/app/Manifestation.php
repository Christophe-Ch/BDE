<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifestation extends Model
{
    //

    public function centre() {
        return $this->belongsTo('App\Centre', 'id_centre');
    }

    public function user() {
        return $this->belongsToMany('App\User');
    }
}
