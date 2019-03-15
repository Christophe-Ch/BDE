<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $fillable = ['user_id', 'manifestation_id'];
    protected $table = 'manifestation_user';
    public $timestamps = false;
}
