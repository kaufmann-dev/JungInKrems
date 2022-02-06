<?php

namespace App\Http\Middleware\Api;

use App\Models\Facility;
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
        
        /* $facility = Facility::find($facilityId);
        foreach($facility->managers as $manager){
            if($manager->ACCOUNT_ID === auth()->user()->ACCOUNT_ID){
                return $next($request);
            }
        }
        return response()->json(['error' => 'Unauthorized. You do not manage this facility.'], 401); */
    }
}
