<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\organizer\ReservationController as OrganizerReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\EventController as userEventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\EventController as AdminEventController;
use App\Http\Controllers\organizer\EventController as OrganizerEventController;
use App\Http\Controllers\user\ReservationController as UserReservationController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('statistics',[UserController::class, 'statistics'])->name('statistics');
    Route::get('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::get('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('events', AdminEventController::class);
    Route::get('/events/{event}/accept', [AdminEventController::class, 'accept'])->name('events.accept');
    Route::get('/events/{event}/decline', [AdminEventController::class, 'decline'])->name('events.decline');
});

Route::middleware(['auth', 'IsOrganizer'])->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('statistics',[OrganizerEventController::class, 'statistics'])->name('statistics');
    Route::resource('events', OrganizerEventController::class);
    Route::resource('reservations', OrganizerReservationController::class);
    Route::get('/reservations/{reservation}/accept', [OrganizerReservationController::class, 'accept'])->name('reservations.accept');
    Route::get('/reservations/{reservation}/decline', [OrganizerReservationController::class, 'decline'])->name('reservations.decline');
    Route::get('/events/{event}/cancel', [OrganizerEventController::class, 'cancel'])->name('events.cancel');
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::resource('events', userEventController::class);
    Route::get('/reservations/create/{id}', [UserReservationController::class, 'create'])->name('reservations.create');
    Route::resource('reservations', UserReservationController::class)->except(['create']);
    Route::get('/download-ticket/{ticketId}', [UserReservationController::class,'ticket_download'])->name('ticket_download');
});

