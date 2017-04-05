<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $table = 'sites';

    protected $fillable = ['name','operation_time','image','facility','lat','lng','user_id'];

    protected $hidden = ['user_id'];


    public function user(){
    	return $this->belongsTo('App\User');
    }
}
