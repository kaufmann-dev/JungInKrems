<?php

namespace App\Http\Controllers\Web;

use App\Models\Facility;
use App\Models\Bookmark;
use App\Http\Controllers\Controller;
use App\Http\Traits\FacilityTrait;
use App\Models\AccountHasFacilities;
use App\Models\AccountHasBookmarks;
use App\Models\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    use FacilityTrait;

    public function createFacility()
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());
        $this->requireNew(request());

        $bookmark = Bookmark::create();
        $bookmark->save();
        request()->merge(['FACILITY_ID' => $bookmark->BOOKMARK_ID]);

        request()->merge(['ACCOUNT_ID' => request()->user()->ACCOUNT_ID]);

        $file = request()->file('IMAGE');
        $fileName = $file->getClientOriginalName();
        Storage::disk('uploads')->putFileAs('/images/uploads', $file, $fileName);
        request()->merge(['IMAGE_PATH' => $fileName]);

        $facility = Facility::create(request()->all());

        $facility->managers()->attach(request()->user());
        $facility->load('managers');

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
        $this->requireUpdate(request());
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

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);
        $facility->delete();

        $bookmarks = AccountHasBookmarks::where('BOOKMARK_ID', $id)->get();
        foreach($bookmarks as $bookmark) {
            $bookmark->delete();
        }
    }

    public function adminUpdateFacility($id)
    {
        $this->requireUpdate(request());
        $this->requireAdminUpdate(request());

        request()->IS_CITY_VERIFIED == 'true' ? request()->merge(['IS_CITY_VERIFIED' => 1]) : request()->merge(['IS_CITY_VERIFIED' => 0]);

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

    public function addFacilityManager()
    {
        $this->validateRequest(request());
        $this->validateNewManager(request());

        $accountId = Account::where('EMAIL', request()->EMAIL)->first()->ACCOUNT_ID;
        $facility = Facility::find(request()->FACILITY_ID);

        if(AccountHasFacilities::where('ACCOUNT_ID', $accountId)->where('FACILITY_ID', request()->FACILITY_ID)->first()) {
            return response()->json(['message' => 'Dieser Account ist bereits Manager dieser Einrichtung.'], 400);
        }

        $facility->managers()->attach($accountId);
        $facility->load('managers');
    }

    public function deleteFacilityManager($id)
    {
        $facility = Facility::find(request()->FACILITY_ID);
        $facility->managers()->detach($id);
        $facility->load('managers');
    }
}