<?php

namespace App\Http\Traits;
use App\Models\Account;
use Illuminate\Http\Request;

trait EventTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'FACILITY_ID' => 'nullable|in:' . request()->user()->managesFacilities()->pluck('FACILITY_ID')->implode(','),
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
        ], [
            'FACILITY_ID.in' => 'You are not allowed to add an event to this facility.',
            'PHONE_NR.min' => 'The phone number must be at least 10 characters.',
            'TITLE.required' => 'The title is required.',
            'DESCRIPTION.required' => 'The description is required.',
            'STARTING_TIME.required' => 'The starting time is required.',
            'POSTAL_CODE.required' => 'The postal code is required.',
            'POSTAL_CODE.numeric' => 'The postal code must be a number.',
            'CITY.required' => 'The city is required.',
            'ADDRESS.required' => 'The address is required.',
            'IMAGE_PATH.required' => 'The image is required.',
            'EVENT_TYPE.required' => 'The event type is required.',
        ]);
    }
}