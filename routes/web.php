<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    DashboardController,
    EventController,
    GuestController,
    BudgetController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aqui estão todas as rotas do sistema EasyBudget.
| Elas estão divididas por seções para melhor organização.
|--------------------------------------------------------------------------
*/

// 🌐 Página inicial (home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔐 Autenticação (Laravel Breeze)
require __DIR__.'/auth.php';

// 🧭 Rotas protegidas — somente para usuários logados
Route::middleware(['auth'])->group(function () {

    // 📊 Dashboard
    Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');

    // 🎟️ Eventos (CRUD completo)
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // 💰 Orçamento / Relatórios
    Route::get('/events/{id}/budget', [EventController::class, 'budget'])->name('events.budget');
    Route::get('/events/{id}/report', [EventController::class, 'report'])->name('events.report');
    Route::get('/events/{id}/report/pdf', [EventController::class, 'downloadPDF'])->name('events.report.pdf');
    Route::get('/events/{id}/report/{type}', [EventController::class, 'generateReport'])->name('events.report.strategy');

    // 🧾 Orçamentos (BudgetController)
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');
    Route::delete('/budgets/{id}', [BudgetController::class, 'destroy'])->name('budgets.destroy');

    // 🧍‍♂️ Convidados por evento
    Route::get('/events/{event}/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::post('/events/{event}/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::post('/events/{event}/guests/{guest}/confirm', [GuestController::class, 'confirm'])->name('guests.confirm');
    Route::delete('/events/{event}/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');

    // 👤 Perfil do usuário (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
