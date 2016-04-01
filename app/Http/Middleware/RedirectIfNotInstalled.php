<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Configuration;
class RedirectIfNotInstalled
{
    public function handle($request, Closure $next)
    {
        $configuration = Configuration::find(1);
        if (isset($configuration)) 
        {
            if ($configuration->installed == 0)
                return redirect('/install');
        }
        return $next($request);
    }
}
