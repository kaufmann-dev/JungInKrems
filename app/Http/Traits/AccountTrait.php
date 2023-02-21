<?php

namespace App\Http\Traits;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AccountTrait
{
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:ACCOUNTS_ST,EMAIL',
            'password' => 'required|confirmed|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'terms' => 'accepted'
        ], [
            'name.required' => 'Der Name ist erforderlich.',
            'name.max' => 'Der Name darf maximal 255 Zeichen lang sein.',
            'email.required' => 'Die E-Mail-Adresse ist erforderlich.',
            'email.email' => 'Die E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
            'email.unique' => 'Die E-Mail-Adresse ist bereits vergeben.',
            'password.required' => 'Das Passwort ist erforderlich.',
            'password.confirmed' => 'Die Passwörter stimmen nicht überein.',
            'password.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'password.max' => 'Das Passwort darf maximal 255 Zeichen lang sein.',
            'password.regex' => 'Das Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',
            'terms.accepted' => 'Die Nutzungsbedingungen müssen akzeptiert werden.'
        ]);
    }

    public function validateUserDetailUpdate(Request $request)
    {
        $this->validate($request, [
            'NAME' => 'required|string',
            'EMAIL' => 'required|email',
        ], [
            'NAME.required' => 'The name is required.',
            'NAME.string' => 'The name must be a string.',
            'EMAIL.required' => 'The email is required.',
            'EMAIL.email' => 'The email must be a valid email address.',
        ]);
    }

    public function validateAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'ACCOUNT_ID' => 'required|numeric',
            'NAME' => 'required|string',
            'EMAIL' => 'required|email',
            'PASSWORD' => 'nullable|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'IS_EMAIL_VERIFIED' => 'required|boolean',
            'ACCOUNT_TYPE' => 'required|in:Systemverwalter,Benutzer,Veranstalter',
        ], [
            'ACCOUNT_ID.required' => 'The account id is required.',
            'ACCOUNT_ID.numeric' => 'The account id must be a number.',
            'NAME.required' => 'The name is required.',
            'NAME.string' => 'The name must be a string.',
            'EMAIL.required' => 'The email is required.',
            'EMAIL.email' => 'The email must be a valid email address.',
            'PASSWORD.string' => 'The password must be a string.',
            'PASSWORD.min' => 'The password must be at least 8 characters long.',
            'PASSWORD.regex' => 'The password must contain at least 1 uppercase, 1 lowercase and 1 number.',
            'IS_EMAIL_VERIFIED.required' => 'The email verification status is required.',
            'IS_EMAIL_VERIFIED.boolean' => 'The email verification status must be a boolean.',
            'ACCOUNT_TYPE.required' => 'The account type is required.',
            'ACCOUNT_TYPE.in' => 'The account type must be one of the following: Systemverwalter, Benutzer, Veranstalter.',
        ]);
    }

    public function validateUserPasswordReset(Request $request)
    {
        $this->validate($request, [
            'OLD_PASSWORD' => 'required|current_password',
            'PASSWORD' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'PASSWORD_CONFIRMATION' => 'required|same:PASSWORD',
        ], [
            'OLD_PASSWORD.required' => 'The old password is required.',
            'OLD_PASSWORD.current_password' => 'The old password is incorrect.',
            'PASSWORD.required' => 'The new password is required.',
            'PASSWORD.string' => 'The new password must be a string.',
            'PASSWORD.min' => 'The new password must be at least 8 characters long.',
            'PASSWORD.regex' => 'The new password must contain at least 1 uppercase, 1 lowercase and 1 number.',
            'PASSWORD_CONFIRMATION.required' => 'The password confirmation is required.',
            'PASSWORD_CONFIRMATION.same' => 'The password confirmation does not match the new password.',
        ]);
    }
}