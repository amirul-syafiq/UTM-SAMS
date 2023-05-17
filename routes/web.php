<?php

use App\Http\Controllers\DashboardController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventAdvertisementController;

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
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/search', [DashboardController::class, 'searchEvent'])->name('dashboard.search');

    // Event
    Route::get('event', function () {
        return view('eventManagement.eventDetails');
    })->name('createEventForm');

    Route::post('/events', [EventController::class, 'createEvent'])->name('event.createEvent');
    Route::get('/events', [EventController::class, 'viewEvent'])->name('event.viewEvent');
    Route::get('/events/{eventId}', [EventController::class, 'editEventDetails'])->name('event.editEventDetails');
    Route::put('/events/{eventId}', [EventController::class, 'updateEvent'])->name('event.updateEvent');

    // Event Advertisement
    Route::get('/event-advertisement', [EventAdvertisementController::class, 'index'])->name('event-advertisement.index');
    Route::get('/view-event-advertisement/{event_id}', [EventAdvertisementController::class, 'viewMyEventAdvertisement'])->name('event-advertisement.view');
    Route::get('/create-event-advertisement-form/{clubEventId}', [EventAdvertisementController::class, 'eventAdvertisementForm'])->name('event-advertisement.create');
    Route::get('/edit-event-advertisement-form/{clubEventId}/{eventAdvertisementId}', [EventAdvertisementController::class, 'eventAdvertisementForm'])->name('event-advertisement.edit');
    Route::post('/store-event-advertisement/{clubEventId}/{eventAdvertisementId?}', [EventAdvertisementController::class, 'store'])->name('event-advertisement.store');

});


