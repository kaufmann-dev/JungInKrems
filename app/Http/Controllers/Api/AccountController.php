<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Http\Traits\AccountTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use AccountTrait;

    public function login()
    {
        $this->validateLogin(request());

        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = request()->user()->createToken('Token Name')->plainTextToken;
            
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Wrong credentials.'], 401);
    }

    public function register()
    {
        $this->validateRegisterApi(request());

        $account = Account::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'name' => request('name')
        ]);

        $token = $account->createToken('Token Name')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function getAccount()
    {
        return response()->json(request()->user(), 200);
    }

    public function deleteAccount()
    {
        $account = Auth::user();
        $account->delete();
        
        return response()->json(['message' => "Deleted account."], 200);
    }
}
