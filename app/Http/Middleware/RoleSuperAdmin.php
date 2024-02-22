<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Auth;
use Redirect;

class RoleSuperAdmin
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
        if(Auth::User()==null)
        {
           return Redirect::to('cpanel/login');  
        }
        
        $users = User::where('email',Auth::User()->email)->first();
        if(!empty($users) && $users->user_type == 1){

            return $next($request);
        } else {
            abort('403');
        }
    }
}
