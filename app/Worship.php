<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worship extends Model
{
    protected $table = 'worships';

    protected $fillable = ['name','address','lat','lng','image','religion_type','user_id'];

    protected $hidden = ['user_id'];

    public function user(){
    	$this->belongsTo('App/User');
    }
}
