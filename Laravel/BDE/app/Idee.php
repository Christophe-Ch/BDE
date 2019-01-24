<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idee extends Model
{
    //

    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function votes() {
        return $this->belongsToMany('App\User');
    }

    public function centre() {
        return $this->belongsTo('App\Centre');
    }
}
