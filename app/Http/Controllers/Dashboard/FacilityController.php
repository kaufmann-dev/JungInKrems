<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Facility;
use App\Models\Bookmark;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Traits\FacilityTrait;

class FacilityController extends Controller
{
    /* use FacilityTrait;
    public function createFacility()
    {
        $bookmark = Bookmark::create();
        $bookmark->save();

        $this->validateRequest(request());

        $facility = Facility::create(request()->all());
    } */

}