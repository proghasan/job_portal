<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Job(){
        return $this->hasMany('App\Job');
    }

    public function Company(){
        return $this->hasOne('App\Company');
    }

    public function Apply(){
        return $this->hasMany('App\Apply');
    }

    public function EmployeeBasicInfo(){
        return $this->hasOne('App\EmployeeBasicInfo');
    }

    public function Education(){
        return $this->hasMany('App\Education');
    }
    public function WorkExperience(){
        return $this->hasMany('App\WorkExperience');
    }
}
