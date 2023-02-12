<?php

use App\Models\AccountHasBookmarks;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Account;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

// Home
Route::inertia('/', 'Home');

// Authentication
Route::inertia('/login', 'Login')->name('login');
Route::inertia('/register', 'Register')->name('register');
Route::inertia('/logout', 'Logout')->name('logout');

// Account
Route::inertia('/bookmarks', 'Bookmarks');
Route::inertia('/account', 'Account');

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
            'requests' => Request::all()
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
Route::get('/new', function () {
    return Inertia::render('CreateEvent');
});

// Facilities
Route::get('/facilities', function () {
    return Inertia::render('Facilities', [
        'facilities' => Facility::all()
    ]);
});
Route::get('/facilities/{id}', function ($id) {
    return Inertia::render('Facility', [
        'facility' => Facility::find($id)
    ]);
});

Route::get('/error', function () {
    return Inertia::render('Error');
})->name('error');
