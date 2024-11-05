<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::get('/dashboard', function () {
        return Inertia::render('AuthPages/Dashboard');
    })->name('dashboard');

    // card crud routes
    Route::resource('card', CardController::class)->only([/*'index',*/'store', 'update', 'destroy'])
        ->names([
            // 'index' => 'card.index'
            'store' => 'card.store', // POST - /card
            // 'create' => 'card.create', // GET - /card
            'update' => 'card.update', // PUT/PATCH - /card/{card}
            'destroy' => 'card.destroy', // DELETE - /card/{card}
            // 'edit' => 'card.edit', // GET
        ]);

    Route::delete('/card/{id}', [CardController::class, 'forget'])->name('card.forget'); // forget
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
