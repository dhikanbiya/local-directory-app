<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token','active','web'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','active'
    ];

    public function office(){
        return $this->hasMany('App\Office');  
    }

    public function fuel(){
        return $this->hasMany('App\Fuel');  
    }

    public function site(){
        return $this->hasMany('App\Site');  
    }

    public function worship(){
        return $this->hasMany('App\Worship');  
    }

    public function restaurant(){
        return $this->hasMany('App\Restaurant');  
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function role(){
        return $this->hasOne('App\Role');
    }

}
