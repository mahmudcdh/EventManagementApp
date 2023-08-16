<?php

use App\Http\Controllers\EventController;
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

    //Event Route
    Route::get('/apiEventsList',[EventController::class, 'apiEventsList']);
    Route::get('/apiEventView/{id}',[EventController::class, 'apiEventView']);
    Route::post('/eventCreate',[EventController::class, 'eventCreate']);
    Route::post('/eventUpdate/{id}',[EventController::class, 'eventUpdate']);
    Route::post('/destroy/{id}',[EventController::class, 'destroy']);
    Route::get('/events-list',[EventController::class, 'eventsList'])->name('events-list');
    Route::get('/add-event',[EventController::class, 'addEvent'])->name('add-event');
});

require __DIR__.'/auth.php';
