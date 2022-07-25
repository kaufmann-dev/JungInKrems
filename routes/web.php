<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BookmarkController;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\FacilityController;
use App\Http\Controllers\Web\PasswordController;
use App\Http\Controllers\Web\RequestController;
use App\Http\Controllers\Web\VerificationController;

require __DIR__.'/render.php';

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


// Authentication Routes
Route::post('/login', [AccountController::class, 'login']);
Route::post('/register', [AccountController::class, 'register']);

// Password Forgotten Routes
Route::post('/password/forgot', [PasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [PasswordController::class, 'resetPassword']);

// Authenticated Middleware
Route::middleware('auth')->group(function(){

    // Account Routes
    Route::post('/logout', [AccountController::class, 'logout']);
    Route::post('/email/send-verification', [VerificationController::class, 'sendVerificationEmail']);
    Route::post('/account/delete/', [AccountController::class, 'deleteAccount']);
    Route::post('/account', [AccountController::class, 'updateAccount']);
    Route::post('/password/change', [PasswordController::class, 'changePassword']);

    // Bookmark Routes
    Route::post('bookmarks/delete/{id}', [BookmarkController::class, 'deleteBookmark'])->middleware('isBookmarkOwnerWeb');
    Route::post('bookmarks/{id}', [BookmarkController::class, 'createBookmark']);

    // Verified Email Middleware
    Route::middleware('verified')->group(function(){

        // Event Routes
        Route::post('events', [EventController::class, 'createEvent']);
        Route::post('events/{id}', [EventController::class, 'updateEvent'])->middleware('isEventOwnerWeb');
        Route::post('events/delete/{id}', [EventController::class, 'deleteEvent'])->middleware('isEventOwnerWeb');

        // Facility Routes
        Route::post('facilities', [FacilityController::class, 'createFacility']);
        Route::post('facilities/{id}', [FacilityController::class, 'updateFacility'])->middleware('isFacilityManagerByIdWeb');
        Route::post('facilities/delete/{id}', [FacilityController::class, 'deleteFacility'])->middleware('isFacilityManagerByIdWeb');
        Route::post('facilitymanagers', [FacilityController::class, 'addFacilityManager'])->middleware('isFacilityManagerWeb');
        Route::post('facilitymanagers/delete/{id}', [FacilityController::class, 'deleteFacilityManager'])->middleware('isFacilityManagerByIdWeb');

        // Request Routes
        Route::post('requests', [RequestController::class, 'createRequest'])->middleware('isFacilityManagerWeb');
        /* Route::post('requests/{id}', [RequestController::class, 'updateRequest'])->middleware('isRequestOwnerWeb'); */
        Route::post('requests/delete/{id}', [RequestController::class, 'deleteRequest'])->middleware('isRequestOwnerWeb');

        // System Admin Middleware
        Route::middleware('accountTypeWeb:Systemverwalter')->group(function(){
            Route::post('admin/accounts/{id}', [AccountController::class, 'adminUpdateAccount']);
            Route::post('admin/events/{id}', [EventController::class, 'adminUpdateEvent']);
            Route::post('admin/facilities/{id}', [FacilityController::class, 'adminUpdateFacility']);
            Route::post('admin/requests/{id}', [RequestController::class, 'adminUpdateRequest']);
            Route::post('admin/requests/accept/{id}', [RequestController::class, 'adminAcceptRequest']);
            Route::post('admin/requests/decline/{id}', [RequestController::class, 'adminDeclineRequest']);
            Route::post('admin/accounts/delete/{id}', [AccountController::class, 'adminDeleteAccount']);
        });
    });
});
