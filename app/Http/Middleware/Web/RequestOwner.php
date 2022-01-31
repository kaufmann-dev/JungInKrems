<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class RequestOwner
{
    public function handle($request, Closure $next)
    {
        $requestId = $request->route('id');

        if($request->user()->requests->contains($requestId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter'){
            return $next($request);
        } else {
            return abort(403, 'Sie sind nicht der Antragsteller.');
        }
    }
}
