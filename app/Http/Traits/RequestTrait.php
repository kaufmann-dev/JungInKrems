<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

trait RequestTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'ACCOUNT_ID' => 'required|in:' . request()->user()->ACCOUNT_ID,
            'FACILITY_ID' => 'required|in:' . request()->user()->managesFacilities()->pluck('FACILITY_ID')->implode(','),
            'REQUEST_TYPE' => 'required|in:Freischaltung,Sonstiges',
            'MESSAGE' => 'required|string',
            'STATUS' => 'required|in:Offen,Abgelehnt,Angenommen',
        ], [
            'FACILITY_ID.in' => 'Sie sind nicht dazu berechtigt eine Anfrage für diese Einrichtung zu stellen.',
            'FACILITY_ID.required' => 'Die Einrichtung ist erforderlich.',
            'REQUEST_TYPE.required' => 'Der Anfragetyp ist erforderlich.',
            'REQUEST_TYPE.in' => 'Der Anfragetyp muss entweder Freischaltung oder Sonstiges sein.',
            'MESSAGE.required' => 'Die Nachricht ist erforderlich.',
            'MESSAGE.string' => 'Die Nachricht muss ein String sein.',
            'STATUS.required' => 'Der Status ist erforderlich.',
            'STATUS.in' => 'Der Status muss entweder Offen, Abgelehnt oder Angenommen sein.',
        ]);
    }

    public function validateUpdate(Request $request){
        $this->validate($request, [
            'REQUEST_ID' => 'required|numeric',
            'ACCOUNT_ID' => 'required|numeric',
            'FACILITY_ID' => 'required|numeric',
            'REQUEST_TYPE' => 'required|in:Freischaltung,Sonstiges',
            'MESSAGE' => 'required|string',
            'STATUS' => 'required|in:Offen,Abgelehnt,Angenommen',
        ], [
            'REQUEST_ID.required' => 'Die Antrag ID ist erforderlich.',
            'REQUEST_ID.numeric' => 'Die Antrag ID muss eine Zahl sein.',
            'ACCOUNT_ID.required' => 'Die Account ID ist erforderlich.',
            'ACCOUNT_ID.numeric' => 'Die Account ID muss eine Zahl sein.',
            'FACILITY_ID.required' => 'Die Einrichtungs ID ist erforderlich.',
            'FACILITY_ID.numeric' => 'Die Einrichtungs ID muss eine Zahl sein.',
            'REQUEST_TYPE.required' => 'Der Anfragetyp ist erforderlich.',
            'REQUEST_TYPE.in' => 'Der Anfragetyp muss entweder Freischaltung oder Sonstiges sein.',
            'MESSAGE.required' => 'Die Nachricht ist erforderlich.',
            'MESSAGE.string' => 'Die Nachricht muss ein String sein.',
            'STATUS.required' => 'Der Status ist erforderlich.',
            'STATUS.in' => 'Der Status muss entweder Offen, Abgelehnt oder Angenommen sein.',
        ]);
    }
}