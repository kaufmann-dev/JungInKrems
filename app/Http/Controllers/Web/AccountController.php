<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\AccountTrait;
use Mail;
use App\Mail\VerifyEmail;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Events\Verified;
use Inertia\Inertia;

class AccountController extends Controller
{
    use AccountTrait;

    public function login()
    {
        $this->validateLogin(request());

        $credentials = request()->only('email', 'password');
        $remember = request()->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            return response()->json(['message' => 'Successfully logged in'], 200);
        } else {
            return response()->json(['message' => 'Das Passwort ist falsch.'], 401);
        }
    }

    public function register()
    {
        $this->validateRegister(request());

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
            return response()->json(['message' => 'Successfully deleted account'], 200);
        } else {
            return response()->json(['message' => 'User is not logged in'], 400);
        }
    }

    public function updateAccount()
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());

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
        $this->validatePasswordReset(request());

        if (Auth::check()) {
            $account = Auth::user();
            if(Hash::check(request('OLD_PASSWORD'), $account->PASSWORD)) {
                $account->PASSWORD = Hash::make(request('PASSWORD'));
                $account->save();
            }
        }
    }

    public function sendVerificationEmail()
    {
        $account = Auth::user();
        if($account->hasVerifiedEmail()){
            return response()->json(['message' => 'Email already verified'], 400);
        }
        $account->sendEmailVerificationNotification();
    }

    public function adminUpdateAccount($id)
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());
        $this->requireAdminUpdate(request());

        $account = Account::find($id);

        if(request()->has('PASSWORD')) {
            request()->merge(['PASSWORD' => Hash::make(request()->input('PASSWORD'))]);
        }
        
        $account->update(request()->all());
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
