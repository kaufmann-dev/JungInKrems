<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $account = Account::where('email', request('email'))->first();

        if(!$account)
            return response()->json(['message' => 'Email already exists.']);
        
        if($account->hasVerifiedEmail())
            return response()->json(['message' => 'Email already verified.']);

        $account->sendEmailVerificationNotification();
    }
}
