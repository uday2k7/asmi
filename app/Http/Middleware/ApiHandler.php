<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiHandler
{

    /*
     * Force every request as json response
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $request->headers->set('Accept', 'application/json');

        return $response;
    }
}
