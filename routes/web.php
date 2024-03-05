<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('admin')->group(function () {
    Route::get('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::get('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('events', EventController::class);
    Route::get('/events/{id}/accept', [EventController::class, 'accept'])->name('events.accept');
    Route::get('/events/{id}/decline', [EventController::class, 'decline'])->name('events.decline');
});
