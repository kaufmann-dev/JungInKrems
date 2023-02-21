<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class FacilityManagerById
{
    public function handle($request, Closure $next)
    {
        $faciltiyId = $request->route('id');

        if($request->user()->managesFacilities->contains('FACILITY_ID', $faciltiyId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);
        
        return abort(403, 'Sie verwalten diese Einrichtung nicht.');
    }
}
