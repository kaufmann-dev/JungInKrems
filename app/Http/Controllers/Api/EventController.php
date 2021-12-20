<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function getEvent($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    public function addEvent(Request $request)
    {
        $bookmark=Bookmark::create();
        $request->merge(['EVENT_ID' => $bookmark->BOOKMARK_ID]);

        $request->validate([
            'FACILITY_ID' => 'nullable|in:' . $request->user()->managesFacilities()->pluck('FACILITY_ID')->implode(','),
            'PHONE_NR' => 'nullable|min:10',
            'TITLE' => 'required',
            'DESCRIPTION' => 'required',
            'STARTING_TIME' => 'required',
            'ENDING_TIME' => 'nullable',
            'WEBSITE_URL' => 'nullable|url',
            'EMAIL' => 'nullable|email',
            'POSTAL_CODE' => 'required|numeric',
            'CITY' => 'required',
            'ADDRESS' => 'required',
            'IMAGE_PATH' => 'url|required',
            'EVENT_TYPE' => 'required',
        ]);

        $request->merge(['ACCOUNT_ID' => $request->user()->ACCOUNT_ID]);

        $event = Event::create($request->all());
        return response()->json($event->EVENT_ID);
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::find($id);
        $request->validate([
            'FACILITY_ID' => 'nullable|in:' . $request->user()->managesFacilities()->pluck('FACILITY_ID')->implode(','),
            'PHONE_NR' => 'nullable|min:10',
            'TITLE' => 'required',
            'DESCRIPTION' => 'required',
            'STARTING_TIME' => 'required',
            'ENDING_TIME' => 'nullable',
            'WEBSITE_URL' => 'nullable|url',
            'EMAIL' => 'nullable|email',
            'POSTAL_CODE' => 'required|numeric',
            'CITY' => 'required',
            'ADDRESS' => 'required',
            'IMAGE_PATH' => 'url|required',
            'EVENT_TYPE' => 'required',
        ]);
        $event->update($request->all());
        return response()->json($event);
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json('deleted');
    }
}