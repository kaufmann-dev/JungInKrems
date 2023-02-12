<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class AccountVerified
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->IS_EMAIL_VERIFIED == 0){
            return response()->json(['error' => 'Unauthorized. Your account is not email verified.'], 401);
        }

        return $next($request);
    }
}
