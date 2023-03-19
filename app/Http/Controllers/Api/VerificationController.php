<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return response()->json(['error' => 'Email is already verified.'], 400);
        }
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => "Sent verification email."], 200);
    }
}
