<?php

namespace App\Http\Controllers\Api;

use App\Models\Facility;
use App\Http\Controllers\Controller;
use App\Http\Traits\FacilityTrait;

class FacilityController extends Controller
{
    use FacilityTrait;

    public function getFacilities()
    {
        $facilities = Facility::all();

        return response()->json($facilities, 200);
    }

    public function getFacility($id)
    {
        $facility = Facility::with('managers')->find($id);

        return response()->json($facility, 200);
    }

    public function addFacility()
    {
        $facility = Facility::create(request()->all());

        return response()->json($facility, 200);
    }

    public function updateFacility($id)
    {
        $facility = Facility::find($id);
        $facility->update(request()->all());

        return response()->json($facility, 200);
    }

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);
        $facility->delete();

        return response()->json(['message' => "Deleted facility."], 200);
    }
}