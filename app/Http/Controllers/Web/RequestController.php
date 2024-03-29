<?php

namespace App\Http\Controllers\Web;

use App\Models\Facility;
use App\Http\Controllers\Controller;
use App\Http\Traits\RequestTrait;
use App\Models\Request;

class RequestController extends Controller
{
    use RequestTrait;

    public function createRequest()
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());

        request()->merge([
            'ACCOUNT_ID' => request()->user()->ACCOUNT_ID,
            'STATUS' => 'Offen',
        ]);
        
        $request = Request::create(request()->all());
    }

    public function deleteRequest($id)
    {
        $request = Request::find($id);
        $request->delete();
    }

    public function adminAcceptRequest($id)
    {
        $request = Request::find($id);
        
        if($request->REQUEST_TYPE == 'Freischaltung'){
            $facility = Facility::find($request->FACILITY_ID);
            $facility->IS_CITY_VERIFIED = true;
            $facility->save();
        }

        $request->STATUS = 'Angenommen';
        $request->save();
    }

    public function adminDeclineRequest($id)
    {
        $request = Request::find($id);
        $request->STATUS = 'Abgelehnt';
        $request->save();
    }

    public function adminUpdateRequest($id)
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());
        $this->requireAdminUpdate(request());

        $request = Request::find($id);
        
        $request->update(request()->all());
    }
}