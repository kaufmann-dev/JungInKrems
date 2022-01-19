<?php

namespace App\Http\Controllers\Web;

use App\Models\Facility;
use App\Models\Bookmark;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Traits\FacilityTrait;
use App\Models\AccountHasFacilities;
use App\Models\Request;

class FacilityController extends Controller
{
    use FacilityTrait;

    public function createFacility()
    {
        if (!request()->has('FACILITY_ID')) {
            $bookmark = Bookmark::create();
            $bookmark->save();
            request()->merge(['FACILITY_ID' => $bookmark->BOOKMARK_ID]);
        }

        if(!request()->has('ACCOUNT_ID')) {
            request()->merge(['ACCOUNT_ID' => request()->user()->ACCOUNT_ID]);
        }

        $this->validateRequest(request());

        $facility = Facility::create(request()->all());

        AccountHasFacilities::create([
            'ACCOUNT_ID' => request()->user()->ACCOUNT_ID,
            'FACILITY_ID' => $facility->FACILITY_ID,
        ]);

        Request::create([
            'ACCOUNT_ID' => request()->user()->ACCOUNT_ID,
            'FACILITY_ID' => $facility->FACILITY_ID,
            'STATUS' => 'Offen',
            'REQUEST_TYPE' => 'Freischaltung',
            'MESSAGE' => request()->user()->NAME . ' möchte die Freischaltung für ' . $facility->NAME . ' beantragen.',
        ]);
    }

    public function updateFacility($id)
    {
        $facility = Facility::find($id);
        $this->validateRequest(request());
        $facility->update(request()->all());
    }

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
    }
}