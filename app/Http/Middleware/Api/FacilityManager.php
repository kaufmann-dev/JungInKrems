<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class FacilityManager
{
    public function handle(Request $request, Closure $next)
    {
        $facilityId = $request->route('id');
        if($request->user()->managesFacilities->contains('FACILITY_ID', $facilityId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);

        return abort(403, 'Sie verwalten diese Einrichtung nicht.');
    }
}
