<?php

use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\VerificationController;
use App\Models\AccountHasBookmarks;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Account;
use App\Models\AccountHasFacilities;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

// Home Route
Route::inertia('/', 'Home')->name('home');

// Authentication Routes
Route::inertia('/login', 'Login')->name('login');
Route::inertia('/register', 'Register')->name('register');
Route::inertia('/logout', 'Logout')->name('logout');

// Event Routes
Route::get('/events', function () {
    return Inertia::render('Events', [
        'events' => Event::with(['account', 'facility'])->get()
    ]);
})->name('events');
Route::get('/events/{id}', function ($id) {
    return Inertia::render('Event', [
        'event' => Event::with(['account', 'facility'])->find($id)
    ]);
});

// Facility Routes
Route::get('/facilities', function () {
    return Inertia::render('Facilities', [
        'facilities' => Facility::where('IS_CITY_VERIFIED', 1)->get()
    ]);
});
Route::get('/facilities/{id}', function ($id) {
    return Inertia::render('Facility', [
        'facility' => Facility::with(['managers', 'events'])->find($id)
    ]);
});

// Guest Middleware
Route::middleware('guest')->group(function (){

    // Password Forgotten Routes
    Route::inertia('/forgotpassword', 'PasswordForgot');
    Route::inertia('/resetpassword', 'PasswordReset')->name('password.reset');
});

// Authenticated Middleware
Route::middleware('auth')->group(function(){

    // Bookmarks Routes
    Route::inertia('/bookmarks', 'Bookmarks');

    // Account Routes
    Route::inertia('/account', 'Account');
    Route::inertia('/account/verify', 'Account/Verify')->name('verification.notice');
    Route::get('/account/events', function () {
        return Inertia::render('Account/Events', [
            'events' => Event::with(['account', 'facility'])->where('ACCOUNT_ID', Auth::user()->ACCOUNT_ID)->get()
        ]);
    });
    Route::get('/account/requests', function () {
        return Inertia::render('Account/Requests', [
            'requests' => Request::where('ACCOUNT_ID', Auth::user()->ACCOUNT_ID)->get(),
            'facilities' => AccountHasFacilities::with(['facility'])->where('ACCOUNT_ID', Auth::user()->ACCOUNT_ID)->get()
        ]);
    });
    Route::get('/account/facilities', function () {
        return Inertia::render('Account/Facilities', [
            'facilities' => AccountHasFacilities::with(['facility'])->where('ACCOUNT_ID', Auth::user()->ACCOUNT_ID)->get()
        ]);
    });

    // Signed Middleware
    Route::middleware('signed')->group(function(){
        Route::get('/account/verify/fresh', [VerificationController::class, 'verifyEmail'])->name('verification.verify');
    });

    // Verified Email Middleware
    Route::middleware('verified')->group(function(){

        // Event Routes
        Route::inertia('/newevent', 'CreateEvent');

        // Facility Routes
        Route::inertia('/newfacility', 'CreateFacility');

        // System Admin Middleware
        Route::middleware('accountTypeWeb:Systemverwalter')->group(function(){
            Route::inertia('/dashboard', 'Dashboard');
            Route::get('/dashboard/accounts', function () {
                return Inertia::render('Dashboard/Accounts', [
                    'accounts' => Account::all()
                ]);
            });
            Route::get('/dashboard/facilities', function () {
                return Inertia::render('Dashboard/Facilities', [
                    'facilities' => Facility::all()
                ]);
            });
            Route::get('/dashboard/events', function () {
                return Inertia::render('Dashboard/Events', [
                    'events' => Event::with(['account', 'facility'])->get()
                ]);
            });
            Route::get('/dashboard/bookmarks', function () {
                return Inertia::render('Dashboard/Bookmarks', [
                    'bookmarks' => AccountHasBookmarks::all()
                ]);
            });
            Route::get('/dashboard/requests', function () {
                return Inertia::render('Dashboard/Requests', [
                    'requests' => Request::with(['account', 'facility'])->get()
                ]);
            });
        });
    });
});
