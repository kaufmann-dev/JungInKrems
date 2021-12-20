<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Accept', 'application/json');
        return $response;
    }
}
