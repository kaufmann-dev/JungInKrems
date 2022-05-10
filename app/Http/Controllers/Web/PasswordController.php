<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\Password;
use App\Http\Traits\PasswordResetTrait;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    use PasswordResetTrait;

    public function sendResetLinkEmail()
    {
        $this->validateResetEmail(request());
        
        $status = Password::sendResetLink(
            request()->only('email')
        );

        /*
            return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
        */
    }

    public function resetPassword()
    {
        $this->validateReset(request());

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

    public function changePassword()
    {
        $this->validateChange(request());

        if (Auth::check()) {
            $account = Auth::user();
            if(Hash::check(request('OLD_PASSWORD'), $account->PASSWORD)) {
                $account->PASSWORD = Hash::make(request('PASSWORD'));
                $account->save();
            }
        }
    }
    
}
