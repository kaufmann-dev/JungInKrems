<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\Password;
use App\Http\Traits\PasswordTrait;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    use PasswordTrait;

    public function sendResetLinkEmail()
    {
        $this->validateResetEmail(request());
        
        Password::sendResetLink(
            request()->only('email')
        );
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
