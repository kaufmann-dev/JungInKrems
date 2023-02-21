<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /* public function getRequests(Request $request)
    {
        $requests = $request->user()->requests;
        return response()->json($requests);
    }

    public function deleteRequest(Request $request, $id)
    {
        $request = $request->user()->requests()->where('REQUEST_ID', $id)->first();
        $request->delete();
        return response()->json(['message' => 'Request deleted']);
    } */

    public function getRequest(Request $request, $id)
    {
        $request = $request->user()->requests()->where('REQUEST_ID', $id)->first();
        return response()->json($request);
    }

    public function getRequests(Request $request)
    {
        $requests = $request->user()->requests;
        return response()->json($requests);
    }

    public function addRequest(Request $request, $id)
    {
        $this->validate($request, [
            'REQUEST_TYPE' => 'required',
            'STATUS' => 'required',
            'MESSAGE' => 'required',
        ]);
        $request = $request->user()->requests()->create([
            'ACCOUNT_ID' => $request->user()->ACCOUNT_ID,
            'FACILITY_ID' => $id,
        ]);
        return response()->json($request);
    }

    public function deleteRequest(Request $request, $id)
    {
        $request = $request->user()->requests()->where('REQUEST_ID', $id)->first();
        $request->delete();
        return response()->json(['message' => 'Request deleted']);
    }
}
