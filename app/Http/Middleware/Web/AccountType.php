<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class AccountType
{
    public function handle($request, Closure $next, $userType)
    {
        if (auth()->check() && auth()->user()->ACCOUNT_TYPE === $userType) {
            return $next($request);
        }

        return abort(403);
    }
}
