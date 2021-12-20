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

        $event = Event::find($eventId);
        if($event->user_id !== auth()->user()->id){
            return response()->json(['error' => 'Unauthorized. You are not the owner of this event.'], 401);
        }

        return $next($request);
    }
}
