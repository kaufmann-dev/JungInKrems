<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\RequestController;

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

// Event Routes - DONE
Route::get('/events', [EventController::class, 'getEvents']);
Route::get('/events/{id}', [EventController::class, 'getEvent']);
Route::middleware(['auth:sanctum', 'isVerifiedApi'])->group(function () {
    Route::post('/events', [EventController::class, 'addEvent']);
});
Route::middleware(['auth:sanctum', 'isEventOwnerApi'])->group(function () {
    Route::put('/events/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/events/{id}', [EventController::class, 'deleteEvent']);
});

// Facility Routes
Route::get('/facilities', [FacilityController::class, 'getFacilities']);
Route::get('/facilities/{id}', [FacilityController::class, 'getFacility']);
Route::post('/facilities', [FacilityController::class, 'addFacility']);
Route::middleware(['auth:sanctum', 'isFacilityManagerApi'])->group(function () {
    Route::put('/facilities/{id}', [FacilityController::class, 'updateFacility']);
    Route::delete('/facilities/{id}', [FacilityController::class, 'deleteFacility']);
});

// Account Routes - DONE
Route::post('/login', [AccountController::class, 'login'])->name('login');
Route::post('/register', [AccountController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/account', [AccountController::class, 'getAccount']);
    Route::put('/account', [AccountController::class, 'updateAccount']);
    Route::delete('/account', [AccountController::class, 'deleteAccount']);
});

// Bookmark Routes - DONE
Route::middleware(['auth:sanctum'])->group(function () { 
    Route::get('/bookmarks', [BookmarkController::class, 'getBookmarks'])->middleware('auth:sanctum');
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'deleteBookmark']);
    Route::post('/bookmarks/{id}', [BookmarkController::class, 'addBookmark']);
});

// Request Routes
Route::post('/requests', [RequestController::class, 'addRequest'])->middleware(['auth:sanctum', 'isFacilityManagerApi']);