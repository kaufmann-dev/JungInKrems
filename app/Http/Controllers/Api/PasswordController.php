<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Traits\PasswordResetTrait;

class PasswordController extends Controller
{
    use PasswordResetTrait;

    public function resetPassword(Request $request)
    {
        $request->validate([
            'required|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ],[
            'password.required' => 'Das Passwort ist erforderlich.',
            'password.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'password.max' => 'Das Passwort darf maximal 255 Zeichen lang sein.',
            'password.regex' => 'Das Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben und eine Zahl enthalten.',
        ]);

        $account = Auth::user();

        $account->password = Hash::make(request('password'));
        $account->save();
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $account = Account::where('EMAIL', request('email'))->first();

        if(!$account)
            return response()->json(['message' => 'Email does not exist.']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
    }
    
}
