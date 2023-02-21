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
            'PASSWORD' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'PASSWORD_CONFIRMATION' => 'required|same:PASSWORD',
        ], [
            'PASSWORD.required' => 'The new password is required.',
            'PASSWORD.string' => 'The new password must be a string.',
            'PASSWORD.min' => 'The new password must be at least 8 characters long.',
            'PASSWORD.regex' => 'The new password must contain at least 1 uppercase, 1 lowercase and 1 number.',
            'PASSWORD_CONFIRMATION.required' => 'The password confirmation is required.',
            'PASSWORD_CONFIRMATION.same' => 'The password confirmation does not match the new password.',
        ]);
    }
}