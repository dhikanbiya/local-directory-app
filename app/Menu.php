<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
   
    protected $fillable = ['name','price','image','restaurant_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function restaurant(){
    	return $this->belongsTo('App\Restaurant');
    }
}
