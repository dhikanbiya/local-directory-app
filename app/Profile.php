<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['fullname','address','phone','user_id'];

    protected $hidden = ['user_id'];


    public function user(){
    	return $this->belongsTo('App\User');
    }
}
