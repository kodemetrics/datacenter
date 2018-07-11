<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateUsers
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
        if(!(empty($request->session()->get('id'))){

           // return redirect('home');
        }else{
            //return redirect('welcome');
              //$response->toJson('Invalid Credentials');
        }

        return $next($request);
    }
}
