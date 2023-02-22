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
        request()->merge([
            'ACCOUNT_ID' => request()->user()->ACCOUNT_ID,
            'STATUS' => 'Offen',
        ]);
        
        $this->validateRequest(request());
        
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

    public function updateRequest($id)
    {
        $this->validateRequest(request());
        $request = Request::find($id);
        $request->update(request()->all());
    }

    public function adminUpdateRequest($id)
    {
        $this->validateRequest(request());

        $request = Request::find($id);
        
        $request->update(request()->all());
    }
}