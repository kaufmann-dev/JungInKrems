<?php

namespace App\Http\Middleware\Web;

use Closure;

class RequestOwner
{
    public function handle($request, Closure $next)
    {
        $requestId = $request->route('id');

        if($request->user()->requests->contains('REQUEST_ID', $requestId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);
        
        return abort(403, 'Sie sind nicht der Antragsteller.');
    }
}
