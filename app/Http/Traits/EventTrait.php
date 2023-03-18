<?php

namespace App\Http\Traits;
use App\Models\Account;
use Illuminate\Http\Request;

trait EventTrait
{
    public function validateRequest(Request $request){
        $this->validate($request, [
            'EVENT_ID' => 'integer',
            'FACILITY_ID' => 'integer|required_if:EVENT_TYPE,Bildung',
            'ACCOUNT_ID' => 'integer',
            'TITLE' => 'string|min:5|max:45',
            'DESCRIPTION' => 'string|min:10|max:1000',
            'EVENT_TYPE' => 'string|in:Freizeit,Bildung',
            'PHONE_NR' => array(
                'string',
                'regex:/^(?:\+|0)?\d{1,3}[-.\s]?\(?\d{3}\)?[-.\s]?\d{2,3}[-.\s]?\d{2,3}$/',
                'max:20'
            ),
            'EMAIL' => 'email|max:45',
            'WEBSITE_URL' => 'url|max:255',
            'POSTAL_CODE' => 'integer|digits_between:4,5',
            'CITY' => 'string|min:2|max:45',
            'ADDRESS' => 'string|min:4|max:100',
            'IMAGE' => 'file|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
            'STARTING_TIME' => 'string|max:255',
            'ENDING_TIME' => 'string|max:255',
        ], [
            'EVENT_ID.integer' => 'Die Veranstaltungs ID muss eine Zahl sein.',

            'FACILITY_ID.integer' => 'Die Einrichtungs ID muss eine Zahl sein.',
            'FACILITY_ID.required_if' => 'Die Einrichtungs ID muss angegeben werden, wenn der Veranstaltungstyp Bildung ist.',

            'ACCOUNT_ID.integer' => 'Die Benutzer ID muss eine Zahl sein.',

            'TITLE.string' => 'Der Titel muss ein String sein.',
            'TITLE.min' => 'Der Titel muss mindestens 5 Zeichen lang sein.',
            'TITLE.max' => 'Der Titel darf maximal 45 Zeichen lang sein.',

            'DESCRIPTION.string' => 'Die Beschreibung muss ein String sein.',
            'DESCRIPTION.min' => 'Die Beschreibung muss mindestens 10 Zeichen lang sein.',
            'DESCRIPTION.max' => 'Die Beschreibung darf maximal 1000 Zeichen lang sein.',

            'EVENT_TYPE.string' => 'Der Veranstaltungstyp muss ein String sein.',
            'EVENT_TYPE.in' => 'Der Veranstaltungstyp muss Freizeit oder Bildung sein.',

            'PHONE_NR.string' => 'Die Telefonnummer muss ein String sein.',
            'PHONE_NR.regex' => 'Die Telefonnummer muss eine gültige Telefonnummer sein.',
            'PHONE_NR.max' => 'Die Telefonnummer darf maximal 20 Zeichen lang sein.',

            'WEBSITE_URL.url' => 'Die Website URL muss eine gültige URL sein.',
            'WEBSITE_URL.max' => 'Die Website URL darf maximal 255 Zeichen lang sein.',

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
            'IMAGE.image' => 'Das Bild muss ein Bild sein.',
            'IMAGE.mimes' => 'Das Bild muss eine der folgenden Dateiendungen haben: webp, jpeg, png, jpg, gif, svg.',
            'IMAGE.max' => 'Das Bild darf maximal 2048 Kilobytes groß sein.',

            'STARTING_TIME.string' => 'Die Startzeit muss ein String sein.',
            'STARTING_TIME.max' => 'Die Startzeit darf maximal 255 Zeichen lang sein.',

            'ENDING_TIME.string' => 'Die Endzeit muss ein String sein.',
            'ENDING_TIME.max' => 'Die Endzeit darf maximal 255 Zeichen lang sein.',
        ]);
    }

    public function requireAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'ACCOUNT_ID' => 'required',
            'EVENT_TYPE' => 'required',
        ], [
            'ACCOUNT_ID.required' => 'Die Benutzer-ID muss ausgefüllt sein.',
            'EVENT_TYPE.required' => 'Der Typ muss ausgefüllt sein.',
        ]);
    }

    public function requireUpdate(Request $request)
    {
        $this->validate($request, [
            'TITLE' => 'required',
            'DESCRIPTION' => 'required',
            'STARTING_TIME' => 'required',
            'POSTAL_CODE' => 'required',
            'CITY' => 'required',
            'ADDRESS' => 'required',
        ], [
            'TITLE.required' => 'Der Titel muss ausgefüllt sein.',
            'DESCRIPTION.required' => 'Die Beschreibung muss ausgefüllt sein.',
            'STARTING_TIME.required' => 'Die Startzeit muss ausgefüllt sein.',
            'POSTAL_CODE.required' => 'Die Postleitzahl muss ausgefüllt sein.',
            'CITY.required' => 'Die Stadt muss ausgefüllt sein.',
            'ADDRESS.required' => 'Die Adresse muss ausgefüllt sein.',
        ]);
    }
}