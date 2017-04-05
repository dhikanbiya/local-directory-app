<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Support\Facades\DB;

class simpleAuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        $row = DB::table('users')->where([
            ['email',$request->header('email')],
            ['api_token',$request->header('api_token')]
        ])->count();
        
        if($row > 0){
         return $next($request);
        }else{
         return response()->json(array('status'=>'false','data'=>''));
        }
        // return $next($request);
    }
}
