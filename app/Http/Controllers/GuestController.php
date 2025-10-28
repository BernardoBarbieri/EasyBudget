<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Event;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Mostra todos os convidados de um evento específico.
     */
    public function index($event_id)
    {
        $event = Event::findOrFail($event_id);
        $guests = $event->guests ?? collect(); // Evita erro se não houver convidados

        return view('guests.index', compact('event', 'guests'));
    }

    /**
     * Armazena um novo convidado no banco.
     */
    public function store(Request $request, $event_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        Guest::create([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'event_id' => $event_id,
            'confirmed' => false,
        ]);

        return redirect()->route('guests.index', $event_id)
                         ->with('success', 'Convidado adicionado com sucesso!');
    }

    /**
     * Marca um convidado como confirmado.
     */
    public function confirm($event_id, $guest_id)
    {
        $guest = Guest::where('event_id', $event_id)->findOrFail($guest_id);
        $guest->update(['confirmed' => true]);

        return redirect()->route('guests.index', $event_id)
                         ->with('success', 'Presença confirmada com sucesso!');
    }

    /**
     * Exclui um convidado.
     */
    public function destroy($event_id, $guest_id)
    {
        $guest = Guest::where('event_id', $event_id)->findOrFail($guest_id);
        $guest->delete();

        return redirect()->route('guests.index', $event_id)
                         ->with('success', 'Convidado removido com sucesso!');
    }
}
