<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CometChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ECertificateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventAdvertisementController;
use App\Http\Controllers\ParticipantController;
use App\Models\Participant;

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
    Route::get('/dashboard/search', [DashboardController::class, 'searchEvent'])->name('dashboard.search');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Event
    Route::get('event', function () {
        return view('eventManagement.eventDetails');
    })->name('createEventForm');

    Route::post('/events', [EventController::class, 'createEvent'])->name('event.createEvent');
    Route::get('/events', [EventController::class, 'viewEvent'])->name('event.viewEvent');
    Route::get('/events/{eventId}', [EventController::class, 'editEventDetails'])->name('event.editEventDetails');
    Route::put('/events/{eventId}', [EventController::class, 'updateEvent'])->name('event.updateEvent');

    // Event Advertisement
    Route::get('/view-event-advertisement-detail/{eventAdvertisement_id}', [EventAdvertisementController::class, 'viewEventAdvertisementDetail'])->name('event-advertisement.view');
    Route::get('/view-my-event-advertisement/{event_id}', [EventAdvertisementController::class, 'viewMyEventAdvertisement'])->name('event-advertisement-my-list.view');
    Route::get('/create-event-advertisement-form/{clubEventId}', [EventAdvertisementController::class, 'eventAdvertisementForm'])->name('event-advertisement.create');
    Route::get('/edit-event-advertisement-form/{clubEventId}/{eventAdvertisementId}', [EventAdvertisementController::class, 'eventAdvertisementForm'])->name('event-advertisement.edit');
    Route::post('/store-event-advertisement/{clubEventId}/{eventAdvertisementId?}', [EventAdvertisementController::class, 'store'])->name('event-advertisement.store');

    // Notification route
    Route::post('/pushNoti',[EventAdvertisementController::class, 'subscribeNoti'])->name('pushNoti');
    Route::get('/getNoti',[EventAdvertisementController::class, 'pushNoti'])->name('getNoti');




    // Participants
    Route::get('/register-event/{event_id}', [ParticipantController::class, 'create'])->name('participant.create');
    Route::post('/register-event/{event_id}', [ParticipantController::class, 'store'])->name('participant.store');
    Route::get('/view-participant-list/{eventAdvertisementId}', [ParticipantController::class, 'viewParticipantList'])->name('participant.viewParticipantList');
    Route::put('/update-participant-status/{eventAdvertisementId}/{participantId}', [ParticipantController::class, 'updateParticipantStatus'])->name('participant.updateParticipantStatus');
    Route::get('/event-registration-history', [ParticipantController::class, 'viewEventRegistrationHistory'])->name('participant.viewEventRegistrationHistory');

    // Admin
    Route::get('/admin-user-list', [AdminController::class, 'userList'])->name('admin.userList');
    Route::delete('/admin-user-delete/{user_id}', [AdminController::class, 'destroy'])->name('admin.deleteUser');
    Route::match(['get', 'post'], '/admin-user-list-filter', [AdminController::class, 'filterUserList'])->name('admin.userListFilter');
    Route::get('/admin-user-edit/{user_id}', [AdminController::class, 'edit'])->name('admin.editUser');
    Route::put('/admin-user-update/{user_id}', [AdminController::class, 'update'])->name('admin.updateUser');

    // Comet Chat
    Route::get('/chat', [CometChatController::class, 'index']);

    // ECertificate
    // Redirect to ecertificate upload form
    Route::get('create-ecertificate/{eventAdvertisementId}', [ECertificateController::class, 'create'])->name('ecert.create');
    Route::post('store-ecertificate/{eventAdvertisementId}', [ECertificateController::class, 'store'])->name('ecert.store');

    //Set ecert from template
    Route::get('use-template-ecertificate/{eventAdvertisementId}', [ECertificateController::class, 'useEcertTemplate'])->name('ecert.useTemplate');

    // Generate ecertificate for the participant
    Route::get('generate-ecertificate/{eventAdvertisementId}', [ECertificateController::class, 'generateEcert'])->name('ecert.generate');

    Route::fallback(function () {
        return view('404');
    });

});
