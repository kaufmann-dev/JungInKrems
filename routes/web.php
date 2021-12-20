<?php

use App\Http\Controllers\Web\BookmarkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\FacilityController;
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

Route::post('/login', [AccountController::class, 'login']);
Route::post('/logout', [AccountController::class, 'logout']);
Route::post('/register', [AccountController::class, 'register']);

Route::post('events', [EventController::class, 'createEvent']);
Route::put('events/{id}', [EventController::class, 'updateEvent']);
Route::delete('events/{id}', [EventController::class, 'deleteEvent']);

Route::delete('bookmarks/{id}', [BookmarkController::class, 'deleteBookmark']);
Route::post('bookmarks/{id}', [BookmarkController::class, 'createBookmark']);