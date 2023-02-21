<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('Token Name')->plainTextToken;
            
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
        ]);

        $account = Account::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'name' => request('name')
        ]);

        $token = $account->createToken('Token Name')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function getAccount(Request $request)
    {
        if(Auth::check()){
            return $request->user();
        } else{
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
    
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

        $account = Account::where('email', request('email'))->first();

        if(!$account)
            return response()->json(['message' => 'Email does not exist.']);

        $account->sendPasswordResetNotification();
    }
    
}
