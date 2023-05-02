<?php

use App\Http\Controllers\DashboardController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventPromotionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('event', function () {
    return view('eventManagement.eventDetails');
})->name('createEventForm');

Route::post('/events', [EventController::class, 'createEvent'])->name('event.createEvent');
Route::get('/events', [EventController::class, 'viewEvent'])->name('event.viewEvent');
Route::get('/events/{eventId}', [EventController::class, 'editEventDetails'])->name('event.editEventDetails');
Route::put('/events/{eventId}', [EventController::class, 'updateEvent'])->name('event.updateEvent');

// Event Promotion
Route::get('/event-promotion', [EventPromotionController::class, 'index'])->name('event-promotion.index');
Route::get('/my-event-promotion/{event_id}', [EventPromotionController::class, 'viewMyEventPromotion'])->name('event-promotion.viewMyEventPromotion');
