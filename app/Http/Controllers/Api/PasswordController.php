<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Traits\PasswordTrait;

class PasswordController extends Controller
{
    use PasswordTrait;

    public function changePassword()
    {
        $this->validateChangeApi(request());

        if (Auth::check()) {
            $account = Auth::user();
            $account->PASSWORD = Hash::make(request('password'));
            $account->save();
            return response()->json(['message' => "Changed password."], 200);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function sendResetLinkEmail()
    {
        $this->validateResetEmail(request());

        Password::sendResetLink(
            request()->only('email')
        );

        return response()->json(['message' => "Sent password reset email."], 200);
    }
    
}
