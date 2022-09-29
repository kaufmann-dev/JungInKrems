<?php

namespace App\Http\Middleware\Web;

use Closure;

class EventOwner
{
    public function handle($request, Closure $next)
    {
        $eventId = $request->route('id');

        if($request->user()->events->contains('EVENT_ID', $eventId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);
        
        return abort(403, 'Sie sind nicht der Besitzer dieser Veranstaltung.');
    }
}
