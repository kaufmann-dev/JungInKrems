<?php

namespace App\Http\Traits;
use App\Models\Account;
use Illuminate\Http\Request;

trait AccountTrait
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'ACCOUNT_ID' => 'required|numeric',
            'NAME' => 'required|string',
            'EMAIL' => 'required|email',
            'PASSWORD' => 'required|string',
            'IS_EMAIL_VERIFIED' => 'required|boolean',
            'ACCOUNT_TYPE' => 'required|in:Systemverwalter,Benutzer,Veranstalter',
        ], [
            'ACCOUNT_ID.required' => 'The account id is required.',
            'ACCOUNT_ID.numeric' => 'The account id must be a number.',
            'NAME.required' => 'The name is required.',
            'NAME.string' => 'The name must be a string.',
            'EMAIL.required' => 'The email is required.',
            'EMAIL.email' => 'The email must be a valid email address.',
            'PASSWORD.required' => 'The password is required.',
            'PASSWORD.string' => 'The password must be a string.',
            'IS_EMAIL_VERIFIED.required' => 'The email verification status is required.',
            'IS_EMAIL_VERIFIED.boolean' => 'The email verification status must be a boolean.',
            'ACCOUNT_TYPE.required' => 'The account type is required.',
            'ACCOUNT_TYPE.in' => 'The account type must be one of the following: Systemverwalter, Benutzer, Veranstalter.',
        ]);
    }
}