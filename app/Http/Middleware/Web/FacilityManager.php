<?php

namespace App\Http\Middleware\Web;

use Closure;

class FacilityManager
{
    public function handle($request, Closure $next)
    {
        $faciltiyId = (int) $request->FACILITY_ID;

        if($request->user()->managesFacilities->contains('FACILITY_ID', $faciltiyId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);
        
        return abort(403, 'Sie verwalten diese Einrichtung nicht.');
    }
}
