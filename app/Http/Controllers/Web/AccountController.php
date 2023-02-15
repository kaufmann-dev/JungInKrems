<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\AccountTrait;

class AccountController extends Controller
{
    use AccountTrait;

    public function login()
    {
        $credentials = request()->only('email', 'password');

        if(! Account::where('email', request('email'))->exists()) {
            return response()->json(['email' => 'User does not exist'], 400);
        }

        if (Auth::attempt($credentials)) {
            //return back()->withInput();
            //return Inertia::render('Register');
            return response()->json(['message' => 'Successfully logged out'], 200);
        }
        return response()->json(['password' => 'Wrong credentials'], 400);
    }

    public function register()
    {
         request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:ACCOUNTS_ST,EMAIL',
            //'password' => 'required|confirmed|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // at least 1 uppercase, 1 lowercase, 1 number
            'password' => 'required|confirmed|min:8',
            'terms' => 'accepted'
        ]); 

        $account = Account::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'name' => request('name')
        ]);

        Auth::login($account);

        if(Auth::check()) {
            Auth::logout();
            return response()->json(['message' => 'Successfully created account'], 200);
        }
        return response()->json(['message' => 'Failed to create account'], 400);
    }

    public function logout()
    {
        //$token = request()->input('_token');
        if (Auth::check()) {
            Auth::logout();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } else {
            return response()->json(['message' => 'User is not logged in'], 400);
        }
    }

    public function deleteAccount()
    {
        if (Auth::check()) {
            $account = Auth::user();
            $account->delete();
            Auth::logout();
        }
    }

    public function updateAccount()
    {
        $this->validateUpdate(request());
        if (Auth::check()) {
            $account = Auth::user();
            $account->NAME = request('NAME');
            if($account->EMAIL != request('EMAIL')) {
                $account->EMAIL = request('EMAIL');
                $account->IS_EMAIL_VERIFIED = 0;
            }
            $account->save();
        }
    }

    public function resetPassword()
    {
        $this->validatePassword(request());

        if (Auth::check()) {
            $account = Auth::user();
            if(Hash::check(request('OLD_PASSWORD'), $account->PASSWORD)) {
                $account->PASSWORD = Hash::make(request('PASSWORD'));
                $account->save();
            }
        }
    }
}
