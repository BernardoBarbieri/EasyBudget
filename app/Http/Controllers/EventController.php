<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $events = Event::where('user_id', auth()->id())
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
        ->get();

    return view('events.index', compact('events', 'search'));
}



    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
{
    $event = Event::where('user_id', auth()->id())->findOrFail($id);

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date' => 'required|date',
        'location' => 'required|string',
        'category' => 'required|string',
        'status' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('events', 'public');
    }

    $event->update($data);

    return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
}


    public function duplicate($id)
{
    $event = Event::where('user_id', auth()->id())->findOrFail($id);

    $newEvent = $event->replicate(); // copia todos os campos exceto ID
    $newEvent->title = $event->title . ' (Cópia)';
    $newEvent->save();

    return redirect()->route('events.index')->with('success', 'Evento copiado com sucesso!');
}


    public function destroy($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
