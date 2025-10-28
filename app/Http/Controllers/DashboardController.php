<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        // Busca todos os eventos do usuário logado
        $events = Event::where('user_id', $user->id)->get();

        $labels = [];
        $totais = [];

        foreach ($events as $event) {
            $labels[] = $event->title;

            // Soma o total do orçamento desse evento (direto no banco)
            $total = DB::table('budgets')
                ->where('event_id', $event->id)
                ->sum(DB::raw('price * quantity'));

            $totais[] = $total ?? 0;
        }

        // Retorna os dados para a view da dashboard
        return view('dashboard', compact('events', 'labels', 'totais'));
    }
}
