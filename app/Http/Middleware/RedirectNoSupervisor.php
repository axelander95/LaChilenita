<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectNoSupervisor
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
           $user = Auth::user();
           if ($user->role_id != 2) 
           {
               abort(404);
           } 
        }
        else 
            return redirect('/login');
        return $next($request);
    }
}
