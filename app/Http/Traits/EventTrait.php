<?php

namespace App\Http\Traits;
use App\Models\Account;
use Illuminate\Http\Request;

trait EventTrait
{
    public function validateNew(Request $request)
    {
        $this->validate($request, [
            'FACILITY_ID' => 'in:' . request()->user()->managesFacilities()->pluck('FACILITY_ID')->implode(','),
            'PHONE_NR' => 'regex:/^\+?\d{1,3}[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
            'TITLE' => 'required',
            'DESCRIPTION' => 'required',
            'STARTING_TIME' => 'required',
            'WEBSITE_URL' => 'url',
            'EMAIL' => 'email',
            'POSTAL_CODE' => 'required|numeric',
            'CITY' => 'required',
            'ADDRESS' => 'required',
            'IMAGE' => 'required|file|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
            'EVENT_TYPE' => 'required|in:Freizeit,Bildung',
        ], [
            'FACILITY_ID.in' => 'Sie sind nicht berechtigt, ein Event in diese Einrichtung hinzuzufügen.',
            'PHONE_NR.regex' => 'Die Telefonnummer muss eine gültige Telefonnummer sein.',
            'TITLE.required' => 'Der Titel ist erforderlich.',
            'DESCRIPTION.required' => 'Die Beschreibung ist erforderlich.',
            'STARTING_TIME.required' => 'Die Startzeit ist erforderlich.',
            'POSTAL_CODE.required' => 'Die Postleitzahl ist erforderlich.',
            'POSTAL_CODE.numeric' => 'Die Postleitzahl muss eine Nummer sein.',
            'CITY.required' => 'Die Stadt ist erforderlich.',
            'ADDRESS.required' => 'Die Adresse ist erforderlich.',
            'IMAGE.required' => 'Das Bild ist erforderlich.',
            'IMAGE.file' => 'Das Bild muss eine Datei sein.',
            'IMAGE.image' => 'Das Bild muss ein Bild sein.',
            'IMAGE.mimes' => 'Das Bild muss eine der folgenden Dateiendungen haben: webp, jpeg, png, jpg, gif, svg.',
            'IMAGE.max' => 'Das Bild darf nicht größer als 2048 Kilobyte sein.',
            'EVENT_TYPE.required' => 'Der Eventtyp ist erforderlich.',
            'EVENT_TYPE.in' => 'Der Eventtyp muss entweder Freizeit oder Bildung sein.',
        ]);
    }

    public function validateUpdate(Request $request)
    {
        $this->validate($request, [
            'FACILITY_ID' => 'in:' . request()->user()->managesFacilities()->pluck('FACILITY_ID')->implode(','),
            'PHONE_NR' => 'regex:/^\+?\d{1,3}[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
            'WEBSITE_URL' => 'url',
            'EMAIL' => 'email',
            'POSTAL_CODE' => 'numeric',
            'EVENT_TYPE' => 'in:Freizeit,Bildung',
        ], [
            'FACILITY_ID.in' => 'Sie sind nicht berechtigt, ein Event in diese Einrichtung hinzuzufügen.',
            'PHONE_NR.regex' => 'Die Telefonnummer muss eine gültige Telefonnummer sein.',
            'POSTAL_CODE.numeric' => 'Die Postleitzahl muss eine Nummer sein.',
            'IMAGE.file' => 'Das Bild muss eine Datei sein.',
            'IMAGE.image' => 'Das Bild muss ein Bild sein.',
            'IMAGE.mimes' => 'Das Bild muss eine der folgenden Dateiendungen haben: webp, jpeg, png, jpg, gif, svg.',
            'IMAGE.max' => 'Das Bild darf nicht größer als 2048 Kilobyte sein.',
            'EVENT_TYPE.in' => 'Der Eventtyp muss entweder Freizeit oder Bildung sein.',
        ]);
    }
}