<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// storage/image routes
Route::get('/storage/{filename}')->name('image');

Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return Inertia::render('Index');
})->name('index');

Route::name('auth.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [CardController::class, 'index'])->name('dashboard');
    Route::get('/deleted', [CardController::class, 'index_bin'])->name('deleted');

    // card crud routes
    Route::controller(CardController::class)->prefix('card')->name('card.')
        ->group(function () {
            Route::post('/update', 'update')->name('update');
            Route::post('/store', 'store')->name('store');
            Route::delete('/delete/{id}', 'destroy')->name('delete');
            Route::patch('/restore/{id}', 'restore')->name('restore');
            Route::delete('/forget/{id}', 'forget')->name('forget');
        });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
