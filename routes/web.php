<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página inicial SEM exigir login
Route::get('/', function () {
    return view('home'); // sua view inicial
})->name('home');

// Rotas de autenticação Breeze/Jetstream
require __DIR__ . '/auth.php';

// Rotas protegidas (precisam de login)
Route::middleware(['auth'])->group(function () {

   // Dashboard com lista de eventos do usuário
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $events = \App\Models\Event::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('events'));
    })->name('dashboard');

});

    // Eventos
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Orçamentos
    Route::get('/events/{id}/budget', [BudgetController::class, 'show'])->name('events.budget');
    Route::post('/events/{id}/budget', [BudgetController::class, 'store'])->name('events.storeBudget');
    Route::get('/events/{id}/budget/builder', [BudgetController::class, 'builder'])->name('events.budget.builder');

    // Relatórios
    Route::get('/events/{id}/report', [ReportController::class, 'show'])->name('events.report');
    Route::get('/events/{id}/report/pdf', [ReportController::class, 'generatePDF'])->name('events.report.pdf');

    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events/{id}/duplicate', [EventController::class, 'duplicate'])->name('events.duplicate');
    Route::get('/events/{event_id}/guests/pdf', [GuestController::class, 'pdf'])->name('guests.pdf');
    Route::post('/events/{event_id}/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{id}/confirm', [GuestController::class, 'confirm'])->name('guests.confirm');
    Route::delete('/guests/{id}', [GuestController::class, 'destroy'])->name('guests.destroy');
    
    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
});
