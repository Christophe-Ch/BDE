<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    //

    public function articles() {
        return $this->hasMany('\App\Article');
    }

    public function idees() {
        return $this->hasMany('\App\Idee');
    }

    public function manifestations() {
        return $this->hasMany('\App\Manifestation');
    }

    public function users() {
        return $this->hasMany('\App\User');
    }
}
