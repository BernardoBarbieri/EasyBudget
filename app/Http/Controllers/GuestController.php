<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function store(Request $request, $event_id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($event_id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Guest::create([
            'name' => $request->name,
            'event_id' => $event->id,
            'confirmed' => false
        ]);

        return back()->with('success', 'Convidado adicionado!');
    }

    public function confirm($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->confirmed = !$guest->confirmed; // alterna pendente/confirmado
        $guest->save();

        return back()->with('success', 'Status atualizado!');
    }

    public function destroy($id)
    {
        Guest::findOrFail($id)->delete();
        return back()->with('success', 'Convidado removido.');
    }

    // PDF
    public function pdf($event_id)
    {
        $event = Event::where('user_id', auth()->id())->with('guests')->findOrFail($event_id);

        $pdf = Pdf::loadView('guests.pdf', [
            'event' => $event,
            'guests' => $event->guests,
        ]);

        $fileName = 'convidados_' . Str::slug($event->title) . '.pdf';
        return $pdf->download($fileName);
    }
}
