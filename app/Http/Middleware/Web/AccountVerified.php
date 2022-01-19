<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class AccountVerified
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->IS_EMAIL_VERIFIED == 1) {
            return $next($request);
        }

        return abort(403);
    }
}
