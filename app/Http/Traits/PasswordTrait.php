<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use App\Models\Account;

trait PasswordTrait
{
    public function validateReset(Request $request)
    {
        $this->validate($request, [
            'PASSWORD' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'PASSWORD_CONFIRMATION' => 'required|same:PASSWORD',
        ], [
            'PASSWORD.required' => 'Das Passwort ist erforderlich.',
            'PASSWORD.string' => 'Das Passwort muss ein String sein.',
            'PASSWORD.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'PASSWORD.max' => 'Das Passwort darf maximal 255 Zeichen lang sein.',
            'PASSWORD.regex' => 'Das Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',

            'PASSWORD_CONFIRMATION.required' => 'Die Passwortbestätigung ist erforderlich.',
            'PASSWORD_CONFIRMATION.same' => 'Die Passwörter stimmen nicht überein.',
        ]);
    }

    public function validateResetEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|in:' . Account::all()->pluck('EMAIL')->implode(',')
        ],[
            'email.required' => 'Die E-Mail-Adresse ist ein Pflichtfeld',
            'email.email' => 'Die E-Mail-Adresse ist keine gültige E-Mail-Adresse',
            'email.in' => 'Die E-Mail-Adresse ist nicht registriert'
        ]);
    }

    public function validateChange(Request $request)
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

    public function validateChangeApi(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ], [
            'password.required' => 'Das neue Passwort ist erforderlich.',
            'password.string' => 'Das neue Passwort muss ein String sein.',
            'password.min' => 'Das neue Passwort muss mindestens 8 Zeichen lang sein.',
            'password.max' => 'Das neue Passwort darf maximal 255 Zeichen lang sein.',
            'password.regex' => 'Das neue Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',
        ]);
    }
}