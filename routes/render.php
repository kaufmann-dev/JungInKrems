<?php

use App\Models\AccountHasBookmarks;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Account;
use App\Models\AccountHasFacilities;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

// Home
Route::inertia('/', 'Home');

// Authentication
Route::inertia('/login', 'Login')->name('login');
Route::inertia('/register', 'Register')->name('register');
Route::inertia('/logout', 'Logout')->name('logout');
Route::inertia('/resetpassword', 'ResetPassword')->name('reset-password');

// Account
Route::middleware('auth')->group(function () {
    Route::inertia('/bookmarks', 'Bookmarks');
    Route::inertia('/account', 'Account');
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
});

// Dashboard
Route::middleware('accountTypeWeb:Systemverwalter')->group(function () {
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
            'events' => Event::all()
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

// Events
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
Route::inertia('/newevent', 'CreateEvent')->middleware('isVerifiedWeb');

// Facilities
Route::get('/facilities', function () {
    return Inertia::render('Facilities', [
        'facilities' => Facility::where('IS_CITY_VERIFIED', 1)->get()
    ]);
});
Route::get('/facilities/{id}', function ($id) {
    return Inertia::render('Facility', [
        /* 'facility' => Facility::where('IS_CITY_VERIFIED', 1)->find($id) */
        'facility' => Facility::with(['managers', 'events'])->find($id)
    ]);
});
Route::inertia('/newfacility', 'CreateFacility')->middleware('isVerifiedWeb');

// Other
Route::get('/error', function () {
    return Inertia::render('Error');
})->name('error');