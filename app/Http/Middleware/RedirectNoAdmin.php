<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectNoAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
           $user = Auth::user();
           if ($user->role_id != 1) 
           {
               abort(404);
           } 
        }
        else 
            return redirect('/login');
        return $next($request);
    }
}
