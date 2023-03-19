<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Http\Traits\RequestTrait;

class RequestController extends Controller
{
    use RequestTrait;

    public function getRequest($id)
    {
        $request = request()->user()->requests()->where('REQUEST_ID', $id)->first();

        return response()->json($request, 200);
    }

    public function getRequests()
    {
        $requests = request()->user()->requests;

        return response()->json($requests, 200);
    }

    public function addRequest()
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());

        request()->merge([
            'ACCOUNT_ID' => request()->user()->ACCOUNT_ID,
            'STATUS' => 'Offen',
        ]);

        $request = Request::create(request()->all());

        return response()->json($request, 200);
    }

    public function deleteRequest($id)
    {
        $request = request()->user()->requests()->where('REQUEST_ID', $id)->first();

        $request->delete();

        return response()->json(['message' => 'Deleted request.'], 200);
    }
}
