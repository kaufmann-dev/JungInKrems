<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Password;
use App\Http\Traits\PasswordResetTrait;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    use PasswordResetTrait;

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|in:' . Account::all()->pluck('EMAIL')->implode(',')
        ],[
            'email.required' => 'Die E-Mail-Adresse ist ein Pflichtfeld',
            'email.email' => 'Die E-Mail-Adresse ist keine gültige E-Mail-Adresse',
            'email.in' => 'Die E-Mail-Adresse ist nicht registriert'
        ]);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        /* return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]); */
    }

    public function resetPassword(Request $request)
    {
        $this->validateRequest(request());

        $token = request('token');
        $email = request('email');

        $resettable = PasswordResets::where('email', $email)->first();

        if (!$resettable) {
            return response()->json(['error' => 'Invalid email.'], 401);
        }

        if(!Hash::check($token, $resettable->token)){
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        $email = $resettable->email;

        $account = Account::where('EMAIL', $email)->first();

        $account->PASSWORD = Hash::make(request('PASSWORD'));
        $account->save();

        $resettable->delete();
    }
    
}
