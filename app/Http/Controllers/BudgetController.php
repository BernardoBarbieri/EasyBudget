<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
    ]);

    Budget::create([
        'event_id' => $request->event_id,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    return back()->with('success', 'Item adicionado ao orçamento!');
}


    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->back()->with('success', 'Item removido com sucesso!');
    }
}
 