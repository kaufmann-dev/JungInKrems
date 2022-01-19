<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

trait FacilityTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'FACILITY_ID' => 'numeric',
            'NAME' => 'required|string',
            'DESCRIPTION' => 'required|string',
            'WEBSITE_URL' => 'required|url',
            'PHONE_NR' => 'required|min:10|numeric',
            'EMAIL' => 'required|email',
            'POSTAL_CODE' => 'required|numeric',
            'CITY' => 'required|string',
            'ADDRESS' => 'required|string',
            'IMAGE_PATH' => 'required|url',
            'FACILITY_TYPE' => 'required|string|in:BHS,Gymnasium,Realschule,Hauptschule,Grundschule,Kindergarten,Universität',
            'IS_CITY_VERIFIED' => 'boolean',
        ], [
            'FACILITY_ID.required' => 'Die Facility ID ist erforderlich.',
            'FACILITY_ID.numeric' => 'Die Facility ID muss eine Zahl sein.',
            'NAME.required' => 'Der Name ist erforderlich.',
            'NAME.string' => 'Der Name muss ein String sein.',
            'DESCRIPTION.required' => 'Die Beschreibung ist erforderlich.',
            'DESCRIPTION.string' => 'Die Beschreibung muss ein String sein.',
            'WEBSITE_URL.required' => 'Die Website URL ist erforderlich.',
            'WEBSITE_URL.url' => 'Die Website URL muss eine gültige URL sein.',
            'PHONE_NR.required' => 'Die Telefonnummer ist erforderlich.',
            'PHONE_NR.min' => 'Die Telefonnummer muss mindestens 10 Zeichen lang sein.',
            'PHONE_NR.numeric' => 'Die Telefonnummer muss eine Zahl sein.',
            'EMAIL.required' => 'Die E-Mail Adresse ist erforderlich.',
            'EMAIL.email' => 'Die E-Mail Adresse muss eine gültige E-Mail Adresse sein.',
            'POSTAL_CODE.required' => 'Die Postleitzahl ist erforderlich.',
            'POSTAL_CODE.numeric' => 'Die Postleitzahl muss eine Zahl sein.',
            'CITY.required' => 'Die Stadt ist erforderlich.',
            'CITY.string' => 'Die Stadt muss ein String sein.',
            'ADDRESS.required' => 'Die Adresse ist erforderlich.',
            'ADDRESS.string' => 'Die Adresse muss ein String sein.',
            'IMAGE_PATH.required' => 'Das Bild ist erforderlich.',
            'IMAGE_PATH.url' => 'Das Bild muss eine gültige URL sein.',
            'FACILITY_TYPE.required' => 'Der Facility Typ ist erforderlich.',
            'FACILITY_TYPE.string' => 'Der Facility Typ muss ein String sein.',
            'FACILITY_TYPE.in' => 'Der Facility Typ muss einer der folgenden sein: BHS, Gymnasium, Realschule, Hauptschule, Grundschule, Kindergarten, Universität.',
            'IS_CITY_VERIFIED.required' => 'Die Stadtverifizierung ist erforderlich.',
            'IS_CITY_VERIFIED.boolean' => 'Die Stadtverifizierung muss ein Boolean sein.',
        ]);
    }
}