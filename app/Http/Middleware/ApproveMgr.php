<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ApproveMgr
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
        $user = User::where('name',$request->session()->get('name'))->first();
        if ($user->role_id==3) {
            return $next($request);
        }else{
            return redirect('/dashboard')->with('message','You are not authorized to view this page');
        }
        
    }
}
