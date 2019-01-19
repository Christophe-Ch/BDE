<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    
    public function centre() {
        return $this->belongsTo('App\Centre');
    }
}
