<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Apply(){
        return $this->hasMany('App\Apply');
    }
}
