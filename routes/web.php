<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\RegistrationController;


Route::get('/', [EventController::class, 'publicIndex'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('events', AdminEventController::class);

        Route::get(
            'events/{event}/registrations',
            [AdminEventController::class, 'registrations']
        )->name('events.registrations');

        Route::get(
            'events/{event}/registrations/export',
            [AdminEventController::class, 'exportRegistrations']
        )->name('events.registrations.export');
    });

Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');

Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
    ->name('events.register');

Route::patch(
    'registrations/{registration}/cancel',
    [AdminEventController::class, 'cancelRegistration']
)->name('admin.registrations.cancel');



require __DIR__.'/auth.php';
