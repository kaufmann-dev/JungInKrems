<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Traits\PasswordTrait;

class PasswordController extends Controller
{
    use PasswordTrait;

    public function changePassword(Request $request)
    {
        $this->validateChange(request());

        if (Auth::check()) {
            $account = Auth::user();
            if(Hash::check(request('OLD_PASSWORD'), $account->PASSWORD)) {
                $account->PASSWORD = Hash::make(request('PASSWORD'));
                $account->save();
                return response()->json(['message' => "Changed password."], 200);
            }
            return response()->json(['error' => 'Old password does not match.'], 401);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateResetEmail(request());

        Password::sendResetLink(
            $request->only('email')
        );

        return response()->json(['message' => "Sent password reset email."], 200);
    }
    
}
