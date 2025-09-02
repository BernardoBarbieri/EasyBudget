<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function show($id)
    {
        $event = Event::with('budgets')->findOrFail($id);
        return view('budgets.show', compact('event'));
    }

    public function store(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'item' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $event->budgets()->create([
            'item' => $request->item,
            'price' => $request->price,
        ]);

        return redirect()->route('events.budget', $event->id)
                         ->with('success', 'Item de orçamento adicionado com sucesso!');
    }

    public function builder($id)
    {
        $event = Event::with('budgets')->findOrFail($id);
        return view('budgets.builder', compact('event'));
    }
}
