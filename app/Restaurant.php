<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = ['name','description','image','promotion','lat','lng','user_id','address'];
    protected $hidden =['user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function menu(){
    	return $this->hasMany('App\Menu');
    }
}
