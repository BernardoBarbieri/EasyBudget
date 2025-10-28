<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index($eventId)
    {
        $event = Event::with('guests')->findOrFail($eventId);
        return view('guests.index', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $data['event_id'] = $eventId;
        $data['confirmed'] = false;

        Guest::create($data);

        return back()->with('success', 'Convidado adicionado com sucesso!');
    }

    public function confirm($guestId)
    {
        $guest = Guest::findOrFail($guestId);
        $guest->update(['confirmed' => true]);

        return back()->with('success', 'Presença confirmada!');
    }

    public function destroy($guestId)
    {
        $guest = Guest::findOrFail($guestId);
        $guest->delete();

        return back()->with('success', 'Convidado removido com sucesso!');
    }
}
