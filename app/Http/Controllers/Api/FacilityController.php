<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    public function getFacilities()
    {
        $facilities = Facility::all();
        return response()->json($facilities);
    }

    public function getFacility($id)
    {
        $facility = Facility::with('managers')->find($id);
        return response()->json($facility);
    }

    public function addFacility(Request $request)
    {
        $facility = Facility::create($request->all());
        return response()->json($facility);
    }

    public function updateFacility(Request $request, $id)
    {
        $facility = Facility::find($id);
        $facility->update($request->all());
        return response()->json($facility);
    }

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
        return response()->json('deleted');
    }
}