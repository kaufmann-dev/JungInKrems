<?php

use App\Http\Controllers\Web\BookmarkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\FacilityController;
use App\Http\Controllers\Web\RequestController;
use Inertia\Inertia;

require __DIR__.'/render.php';
require __DIR__.'/dashboard.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
Route::post('/login', [AccountController::class, 'login']);
Route::post('/logout', [AccountController::class, 'logout']);
Route::post('/register', [AccountController::class, 'register']);

// Account Routes
Route::delete('/account', [AccountController::class, 'deleteAccount']);
Route::put('/account', [AccountController::class, 'updateAccount']);
Route::post('/reset-password', [AccountController::class, 'resetPassword']);

// Event Routes
Route::post('events', [EventController::class, 'createEvent']);
Route::put('events/{id}', [EventController::class, 'updateEvent']);
Route::delete('events/{id}', [EventController::class, 'deleteEvent']);

// Bookmark Routes
Route::delete('bookmarks/{id}', [BookmarkController::class, 'deleteBookmark']);
Route::post('bookmarks/{id}', [BookmarkController::class, 'createBookmark']);

// Facility Routes
Route::post('facilities', [FacilityController::class, 'createFacility']);
Route::put('facilities/{id}', [FacilityController::class, 'updateFacility']);
Route::delete('facilities/{id}', [FacilityController::class, 'deleteFacility']);

// Request Routes
Route::post('requests', [RequestController::class, 'createRequest']);
Route::put('requests/{id}', [RequestController::class, 'updateRequest']);
Route::delete('requests/{id}', [RequestController::class, 'deleteRequest']);
Route::post('request-accept/{id}', [RequestController::class, 'acceptRequest']);
Route::post('request-decline/{id}', [RequestController::class, 'declineRequest']);

// Admin Routes
// middleware
Route::middleware('accountTypeWeb:Systemverwalter')->group(function () {
    Route::put('accounts/{id}', [DashboardController::class, 'updateAccount']);
});