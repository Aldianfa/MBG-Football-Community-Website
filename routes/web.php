<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/* ---- Home ---- */

Route::get('/', function () {
    return view('pages.home');
})->name('home');

/* ---- Jadwal ---- */
Route::get('/jadwal', function () {
    return view('schedule.index');
})->name('schedule.index');

/* ---- Galeri ---- */
Route::get('/galeri', function () {
    return view('gallery.index');
})->name('gallery.index');

/* ---- Jadwal ---- */
Route::prefix('jadwal')->name('schedule.')->group(function () {

    // Daftar semua event
    Route::get('/', [EventController::class, 'index'])->name('index');

    // Step 1 — Detail event
    Route::get('/{eventId}', [EventController::class, 'show'])->name('show');

    // Step 2 — Pilih tim
    Route::get('/{eventId}/tim', [EventController::class, 'teams'])->name('teams');

    // Step 3 — Form daftar (GET)
    Route::get('/{eventId}/daftar/{teamId}', [EventController::class, 'registerForm'])->name('register.form');

    // Proses submit (POST)
    Route::post('/{eventId}/daftar', [EventController::class, 'registerStore'])->name('register.store');

});

/* ---- Galeri ---- */
// Route::prefix('galeri')->name('gallery.')->group(function () {
//     Route::get('/', [GalleryController::class, 'index'])->name('index');
// });
