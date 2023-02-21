<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait PasswordResetTrait
{
    public function validateRequest(Request $request)
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
}