<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
            'location'    => $request->location,
            'image'       => $request->image,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function edit($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $event = Event::where('user_id', auth()->id())->findOrFail($id);

        $event->update([
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
            'location'    => $request->location,
            'image'       => $request->image,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
