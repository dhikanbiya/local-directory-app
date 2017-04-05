<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $table = 'fuels';

    protected $fillable = [
        'name', 'address', 'phone','lat','lng','picture','information','user_id'
    ];

    protected $hidden = [ 'user_id',
    ];

    public function user(){
	 return $this->belongsTo('App\User');
	}

	
		
}

