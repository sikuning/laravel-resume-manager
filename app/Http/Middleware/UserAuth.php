<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path=$request->path();
      

       if(( $path == "login") && Session::get('username')){
           return redirect('user/my-profile');
       }
       else if(($request->is('user/*')) && (!Session::get('username'))){
           return redirect('login');
       }
      return $next($request);
    }
}
