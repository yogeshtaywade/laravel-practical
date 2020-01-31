<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SuperAdmin
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
        if (Auth::check()) {
            $not_allowed=config()->get('settings.not_acction_admin_roles');
            $role = Auth::user()->roles[0]->name;
            if(in_array($role,$not_allowed)){
                return redirect()->back();
            }
            return $next($request);
        }else{
            return redirect(Route('home'));
        }
    }
}
