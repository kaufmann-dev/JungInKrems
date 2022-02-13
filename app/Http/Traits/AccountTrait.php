<?php

namespace App\Http\Traits;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AccountTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'ACCOUNT_ID' => 'integer',
            'NAME' => 'string|max:30',
            'EMAIL' => 'email|max:45',
            'PASSWORD' => 'string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'IS_EMAIL_VERIFIED' => 'boolean',
            'ACCOUNT_TYPE' => 'string|in:Systemverwalter,Benutzer,Veranstalter',
        ], [
            'ACCOUNT_ID.integer' => 'Die Account-ID muss eine Ganzzahl sein.',

            'NAME.string' => 'Der Name muss ein String sein.',
            'NAME.max' => 'Der Name darf maximal 30 Zeichen lang sein.',

            'EMAIL.email' => 'Die E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
            'EMAIL.max' => 'Die E-Mail-Adresse darf maximal 45 Zeichen lang sein.',

            'PASSWORD.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'PASSWORD.max' => 'Das Passwort darf maximal 255 Zeichen lang sein.',
            'PASSWORD.regex' => 'Das Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',
            'PASSWORD.string' => 'Das Passwort muss ein String sein.',

            'IS_EMAIL_VERIFIED.boolean' => 'Die Email-Verifizierung muss ein Boolean sein.',

            'ACCOUNT_TYPE.in' => 'Der Account-Typ muss ein Systemverwalter, Benutzer oder Veranstalter sein.',
            'ACCOUNT_TYPE.string' => 'Der Account-Typ muss ein String sein.',
        ]);
    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:ACCOUNTS_ST,EMAIL',
            'password' => 'required'
        ],[
            'email.required' => 'Die E-Mail-Adresse ist erforderlich.',
            'email.email' => 'Die E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
            'email.exists' => 'Die E-Mail-Adresse existiert nicht.',

            'password.required' => 'Das Passwort ist erforderlich.'
        ]);
    }
    
    public function validateRegister(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|min:30|max:255',
            'email' => 'required|email|unique:ACCOUNTS_ST,EMAIL|max:255',
            'password' => 'required|confirmed|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'terms' => 'accepted'
        ], [
            'name.required' => 'Der Name ist erforderlich.',
            'name.min' => 'Der Name muss mindestens 30 Zeichen lang sein.',
            'name.max' => 'Der Name darf maximal 255 Zeichen lang sein.',

            'email.required' => 'Die E-Mail-Adresse ist erforderlich.',
            'email.email' => 'Die E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
            'email.unique' => 'Die E-Mail-Adresse ist bereits vergeben.',
            'email.max' => 'Die E-Mail-Adresse darf maximal 255 Zeichen lang sein.',

            'password.required' => 'Das Passwort ist erforderlich.',
            'password.confirmed' => 'Die Passwörter stimmen nicht überein.',
            'password.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'password.max' => 'Das Passwort darf maximal 255 Zeichen lang sein.',
            'password.regex' => 'Das Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',

            'terms.accepted' => 'Die Nutzungsbedingungen müssen akzeptiert werden.'
        ]);
    }

    public function validatePasswordReset(Request $request)
    {
        $this->validate($request, [
            'OLD_PASSWORD' => 'required|current_password',
            'PASSWORD' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'PASSWORD_CONFIRMATION' => 'required|same:PASSWORD',
        ], [
            'OLD_PASSWORD.required' => 'Das alte Passwort ist erforderlich.',
            'OLD_PASSWORD.current_password' => 'Das alte Passwort ist falsch.',

            'PASSWORD.required' => 'Das neue Passwort ist erforderlich.',
            'PASSWORD.string' => 'Das neue Passwort muss ein String sein.',
            'PASSWORD.min' => 'Das neue Passwort muss mindestens 8 Zeichen lang sein.',
            'PASSWORD.max' => 'Das neue Passwort darf maximal 255 Zeichen lang sein.',
            'PASSWORD.regex' => 'Das neue Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',

            'PASSWORD_CONFIRMATION.required' => 'Die Passwortbestätigung ist erforderlich.',
            'PASSWORD_CONFIRMATION.same' => 'Die Passwörter stimmen nicht überein.',
        ]);
    }
}