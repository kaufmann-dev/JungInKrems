<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

trait FacilityTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'FACILITY_ID' => 'integer',
            'NAME' => 'string|min:5|max:45',
            'DESCRIPTION' => 'string|min:10|max:1000',
            'WEBSITE_URL' => 'url|max:255',
            'PHONE_NR' => array(
                'string',
                'regex:/^(?:\+|0)?\d{1,3}[-.\s]?\(?\d{3}\)?[-.\s]?\d{2,3}[-.\s]?\d{2,3}$/',
                'max:20'
            ),
            'EMAIL' => 'email|max:45',
            'POSTAL_CODE' => 'integer|digits_between:4,5',
            'CITY' => 'string|min:2|max:45',
            'ADDRESS' => 'string|min:4|max:100',
            'IMAGE' => 'file|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
            'FACILITY_TYPE' => 'string|in:BHS,Gymnasium,Realschule,Hauptschule,Grundschule,Kindergarten,Universität',
            'IS_CITY_VERIFIED' => 'boolean',
        ], [
            'FACILITY_ID.integer' => 'Die Einrichtungs-ID muss eine Zahl sein.',

            'NAME.string' => 'Der Name muss ein String sein.',
            'NAME.min' => 'Der Name muss mindestens 5 Zeichen lang sein.',
            'NAME.max' => 'Der Name darf maximal 45 Zeichen lang sein.',

            'DESCRIPTION.string' => 'Die Beschreibung muss ein String sein.',
            'DESCRIPTION.min' => 'Die Beschreibung muss mindestens 10 Zeichen lang sein.',
            'DESCRIPTION.max' => 'Die Beschreibung darf maximal 1000 Zeichen lang sein.',

            'WEBSITE_URL.url' => 'Die Website URL muss eine gültige URL sein.',
            'WEBSITE_URL.max' => 'Die Website URL darf maximal 255 Zeichen lang sein.',

            'PHONE_NR.string' => 'Die Telefonnummer muss ein String sein.',
            'PHONE_NR.regex' => 'Die Telefonnummer muss eine gültige Telefonnummer sein.',
            'PHONE_NR.max' => 'Die Telefonnummer darf maximal 20 Zeichen lang sein.',

            'EMAIL.email' => 'Die E-Mail Adresse muss eine gültige E-Mail Adresse sein.',
            'EMAIL.max' => 'Die E-Mail Adresse darf maximal 45 Zeichen lang sein.',

            'POSTAL_CODE.integer' => 'Die Postleitzahl muss eine Zahl sein.',
            'POSTAL_CODE.digits_between' => 'Die Postleitzahl muss zwischen 4 und 5 Ziffern lang sein.',

            'CITY.string' => 'Die Stadt muss ein String sein.',
            'CITY.min' => 'Die Stadt muss mindestens 2 Zeichen lang sein.',
            'CITY.max' => 'Die Stadt darf maximal 45 Zeichen lang sein.',

            'ADDRESS.string' => 'Die Adresse muss ein String sein.',
            'ADDRESS.min' => 'Die Adresse muss mindestens 4 Zeichen lang sein.',
            'ADDRESS.max' => 'Die Adresse darf maximal 100 Zeichen lang sein.',

            'IMAGE.file' => 'Das Bild muss eine Datei sein.',
            'IMAGE.image' => 'Das Bild muss eine Bilddatei sein.',
            'IMAGE.mimes' => 'Das Bild muss im Format .webp, .jpeg, .png, .jpg, .gif oder .svg sein.',
            'IMAGE.max' => 'Das Bild darf maximal 2048 KB groß sein.',

            'FACILITY_TYPE.string' => 'Die Einrichtungsart muss ein String sein.',
            'FACILITY_TYPE.in' => 'Die Einrichtungsart muss entweder BHS, Gymnasium, Realschule, Hauptschule, Grundschule, Kindergarten oder Universität sein.',

            'IS_CITY_VERIFIED.boolean' => 'Die Stadtverifizierung muss ein Boolean sein.',
        ]);
    }

    public function validateNewManager(Request $request)
    {
        $this->validate($request, [
            'EMAIL' => 'required|exists:ACCOUNTS_ST,EMAIL',
        ], [
            'EMAIL.required' => 'Die E-Mail Adresse ist erforderlich.',
            'EMAIL.exists' => 'Die E-Mail Adresse existiert nicht.',
        ]);
    }

    public function requireNew(Request $request)
    {
        $this->validate($request, [
            'IMAGE' => 'required',
        ], [
            'IMAGE.required' => 'Die Bild muss vorhanden sein.',
        ]);
    }

    public function requireUpdate(Request $request)
    {
        $this->validate($request, [
            'TITLE' => 'required',
            'DESCRIPTION' => 'required',
            'FACILITY_TYPE' => 'required',
            'POSTAL_CODE' => 'required',
            'CITY' => 'required',
            'ADDRESS' => 'required',
            'PHONE_NR' => 'required',
            'EMAIL' => 'required',
            'WEBSITE_URL' => 'required',
        ], [
            'TITLE.required' => 'Die E-Mail Adresse ist erforderlich.',
            'FACILITY_TYPE.required' => 'Die Einrichtungsart muss ausgefüllt werden.',
            'POSTAL_CODE.required' => 'Die Postleitzahl muss ausgefüllt werden.',
            'CITY.required' => 'Die Stadt muss ausgefüllt werden.',
            'ADDRESS.required' => 'Die Adresse muss ausgefüllt werden.',
            'PHONE_NR.required' => 'Die Telefonnummer muss ausgefüllt werden.',
            'EMAIL.required' => 'Die E-Mail Adresse ist erforderlich.',
            'WEBSITE_URL.required' => 'Die Website-URL muss ausgefüllt werden.',
        ]);
    }

    public function requireAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'IS_CITY_VERIFIED' => 'required',
        ], [
            'IS_CITY_VERIFIED.required' => 'Die E-Mail Adresse ist erforderlich.',
        ]);
    }
}