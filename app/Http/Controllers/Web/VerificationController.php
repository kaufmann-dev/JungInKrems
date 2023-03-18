<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function sendVerificationEmail()
    {
        $account = Auth::user();
        if($account->hasVerifiedEmail()){
            return response()->json(['message' => 'Email already verified'], 400);
        }
        $account->sendEmailVerificationNotification();
    }

    public function verifyEmail()
    {
        $account = request()->user();

        if (!$account->hasVerifiedEmail()) {
            $account->markEmailAsVerified();
            event(new Verified($account));
        }

        return Inertia::render('Account/Verify');
    }
    
}