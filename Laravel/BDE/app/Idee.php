<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idee extends Model
{
    //

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function centre() {
        return $this->belongsTo('App\Centre', 'id_centre');
    }
}
