<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Budget;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        // Quantidade de eventos e orçamentos
        $events = Event::where('user_id', $user->id)->count();

        $guests = \App\Models\Guest::whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        $totalBudget = Budget::whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum(\DB::raw('price * quantity'));

        // Dados para o gráfico
        $chartLabels = Event::where('user_id', $user->id)->pluck('title');
        $chartValues = Event::where('user_id', $user->id)->get()->map(function ($event) {
            return $event->budgets->sum(fn($b) => $b->price * $b->quantity);
        });

        return view('dashboard', compact('events', 'guests', 'totalBudget', 'chartLabels', 'chartValues'));
    }
}
