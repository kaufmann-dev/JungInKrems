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
    
}
