<?php

namespace App\Http\Controllers\Api;

use App\Models\Facility;
use App\Http\Controllers\Controller;
use App\Http\Traits\FacilityTrait;
use App\Models\AccountHasBookmarks;
use Illuminate\Support\Facades\Storage;
use App\Models\Bookmark;
use App\Models\Request;

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

        return response()->json($facility, 200);
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

        return response()->json($facility, 200);
    }

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);
        $facility->delete();

        $bookmarks = AccountHasBookmarks::where('BOOKMARK_ID', $id)->get();
        foreach($bookmarks as $bookmark) {
            $bookmark->delete();
        }

        return response()->json(['message' => "Deleted facility."], 200);
    }
}