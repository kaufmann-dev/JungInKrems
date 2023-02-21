<?php

namespace App\Http\Controllers\Web;

use App\Models\Facility;
use App\Models\Bookmark;
use App\Http\Controllers\Controller;
use App\Http\Traits\FacilityTrait;
use App\Models\AccountHasFacilities;
use App\Models\Request;
use Illuminate\Support\Facades\Storage;

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
        if(request()->has('IMAGE')){
            $file = request()->file('IMAGE');
            $fileName = $file->getClientOriginalName();
            Storage::disk('uploads')->putFileAs('/images/uploads', $file, $fileName);
            request()->merge(['IMAGE_PATH' => $fileName]);
        }

        $facility = Facility::find($id);
        $this->validateRequest(request());
        $facility->update(request()->all());
    }

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
    }

    public function adminUpdateFacility($id)
    {
        $this->validateRequest(request());

        if(request()->has('IMAGE')){
            $file = request()->file('IMAGE');
            $fileName = $file->getClientOriginalName();
            Storage::disk('uploads')->putFileAs('/images/uploads', $file, $fileName);
            request()->merge(['IMAGE_PATH' => $fileName]);
        }

        $facility = Facility::find($id);

        $facility->update(request()->all());
    }
}