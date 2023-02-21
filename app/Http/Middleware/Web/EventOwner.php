<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class EventOwner
{
    public function handle($request, Closure $next)
    {
        $eventId = $request->route('id');

        if($request->user()->events->contains($eventId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter'){
            return $next($request);
        } else {
            return abort(403, 'Sie sind nicht der Besitzer dieser Veranstaltung.');
        }
    }
}
