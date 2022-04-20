<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\VerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Event Routes
Route::get('/events', [EventController::class, 'getEvents']);
Route::get('/events/{id}', [EventController::class, 'getEvent']);

// Facility Routes
Route::get('/facilities', [FacilityController::class, 'getFacilities']);
Route::get('/facilities/{id}', [FacilityController::class, 'getFacility']);

// Authentication Routes
Route::post('/login', [AccountController::class, 'login'])->name('login');
Route::post('/register', [AccountController::class, 'register'])->name('register');
Route::post('/forgotpassword', [PasswordController::class, 'forgotPassword']);

// Authenticated Middleware
Route::middleware('auth:sanctum')->group(function(){

    // Request Routes
    Route::get('/requests', [RequestController::class, 'getRequests']);
    Route::get('/requests/{id}', [RequestController::class, 'getRequest']);

    // Account Routes
    Route::get('/account', [AccountController::class, 'getAccount']);
    Route::put('/account', [AccountController::class, 'updateAccount']);
    Route::delete('/account', [AccountController::class, 'deleteAccount']);
    Route::post('/verify', [VerificationController::class, 'verifyEmail']);
    Route::post('/resetpassword', [PasswordController::class, 'resetPassword']);

    // Bookmark Routes
    Route::get('/bookmarks', [BookmarkController::class, 'getBookmarks']);
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'deleteBookmark']);
    Route::post('/bookmarks/{id}', [BookmarkController::class, 'addBookmark']);

    // Verified Email Middleware
    Route::middleware('verified')->group(function(){

        // Facility Routes
        Route::post('/facilities', [FacilityController::class, 'addFacility']);
        Route::put('/facilities/{id}', [FacilityController::class, 'updateFacility']);
        Route::delete('/facilities/{id}', [FacilityController::class, 'deleteFacility']);

        // Event Routes
        Route::post('/events', [EventController::class, 'addEvent']);
        Route::put('/events/{id}', [EventController::class, 'updateEvent']);
        Route::delete('/events/{id}', [EventController::class, 'deleteEvent']);

        // Request Routes
        Route::post('/requests', [RequestController::class, 'addRequest']);
        Route::delete('/requests/{id}', [RequestController::class, 'deleteRequest']);

    });
});
