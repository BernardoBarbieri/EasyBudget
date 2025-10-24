<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        // Carrega todos os eventos do usuário já com itens de orçamento
        $events = Event::where('user_id', $user->id)
            ->with('budgets')
            ->get();

        // Total de eventos
        $totalEvents = $events->count();

        // Labels para o gráfico (nomes dos eventos)
        $labels = $events->pluck('title');

        // Soma de orçamento por evento (price * quantity)
        $totals = $events->map(function ($event) {
            return $event->budgets->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        });

        // Envia tudo para a view
        return view('dashboard', compact('events', 'totalEvents', 'labels', 'totals'));
    }
}
