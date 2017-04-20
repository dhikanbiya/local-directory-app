<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;


class ValregController extends Controller
{

		public function index(Request $request){
			 $name = $request->input('name');
       $email = $request->input('email');
       $password = $request->input('password');        

        try {
        $this->validate($request, [
        	'name' => 'required',
            'email' => 'bail|required|unique:users',
            'password' => 'required'
        	]);

        $token = Str::random(20);        

        $save = new User;
        $save->name = $name;
        $save->password = bcrypt($password);
        $save->email = $email;
        $save->api_token = $token;
        $save->save();
        	return response()->json(array('status'=>'success'));

        }catch(ValidationException $e){
        	
        	return response()->json(array('status'=>'true','data'=>array('message'=>$e->validator->errors())));       	
       
			
		}
    	
	}
}