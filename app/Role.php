<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable= ['user_id','admin','web'];

    protected $hidden = ['user_id'];

    public function user(){
    	return $this->hasOne('App\User');
    }
}
