<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

trait RequestTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'REQUEST_ID' => 'integer',
            'ACCOUNT_ID' => 'integer',
            'FACILITY_ID' => 'integer',
            'REQUEST_TYPE' => 'string|in:Freischaltung,Sonstiges',
            'MESSAGE' => 'string|max:1000',
            'STATUS' => 'string|in:Offen,Abgelehnt,Angenommen',
        ], [
            'REQUEST_ID.integer' => 'Die Request ID muss eine Zahl sein.',

            'ACCOUNT_ID.integer' => 'Die Account ID muss eine Zahl sein.',

            'FACILITY_ID.integer' => 'Die Facility ID muss eine Zahl sein.',

            'REQUEST_TYPE.string' => 'Der Request Typ muss ein String sein.',
            'REQUEST_TYPE.in' => 'Der Request Typ muss entweder "Freischaltung" oder "Sonstiges" sein.',

            'MESSAGE.string' => 'Die Message muss ein String sein.',
            'MESSAGE.max' => 'Die Message darf maximal 1000 Zeichen lang sein.',

            'STATUS.string' => 'Der Status muss ein String sein.',
            'STATUS.in' => 'Der Status muss entweder "Offen", "Abgelehnt" oder "Angenommen" sein.',
        ]);
    }

    public function requireUpdate(Request $request)
    {
        $this->validate($request, [
            'FACILITY_ID' => 'required',
            'MESSAGE' => 'required',
            'REQUEST_TYPE' => 'required',
        ], [
           'FACILITY_ID.required' => 'Die Bildungsanstalt muss ausgefüllt sein.',
            'MESSAGE.required' => 'Die Nachricht muss ausgefüllt sein.',
            'REQUEST_TYPE.required' => 'Der Typ muss ausgefüllt sein.',
        ]);
    }

    public function requireAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'ACCOUNT_ID' => 'required',
            'STATUS' => 'required',
        ], [
           'ACCOUNT_ID.required' => 'Die Account ID muss ausgefüllt sein.',
           'STATUS.required' => 'Der Status muss ausgefüllt sein.',
        ]);
    }
}