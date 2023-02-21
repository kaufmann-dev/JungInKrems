<?php

namespace App\Http\Middleware\Api;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;

class EventOwner
{
    public function handle(Request $request, Closure $next)
    {
        $eventId = $request->route('id');

        if($request->user()->events->contains('EVENT_ID', $eventId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);
            
        return abort(403, 'Sie sind nicht der Besitzer dieser Veranstaltung.');
        
        /* $event = Event::find($eventId);
        if($event->user_id !== auth()->user()->id){
            return response()->json(['error' => 'Unauthorized. You are not the owner of this event.'], 401);
        }

        return $next($request); */
    }
}
