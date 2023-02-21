<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class FacilityManager
{
    public function handle($request, Closure $next)
    {
        $faciltiyId = $request->route('id');

        if($request->user()->managesFacilities->contains($faciltiyId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter'){
            return $next($request);
        } else {
            return abort(403, 'Sie verwalten diese Einrichtung nicht.');
        }
    }
}
