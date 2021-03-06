<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Role;
use App\User;

class IsAdmin
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
        if(Auth::user() && Auth::user()->level==1){
          return $next($request);  
        }else{
            return redirect()->route('home');
        }        
        
    }
}
