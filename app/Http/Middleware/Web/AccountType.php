<?php

namespace App\Http\Middleware\Web;

use Closure;

class AccountType
{
    public function handle($request, Closure $next, $userType)
    {
        if (auth()->check() && auth()->user()->ACCOUNT_TYPE === $userType) {
            return $next($request);
        }

        return abort(403, 'Sie sind kein ' . $userType . '.');
    }
}
