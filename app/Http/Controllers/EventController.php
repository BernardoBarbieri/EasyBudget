<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Strategies\Report\SummaryReport;
use App\Strategies\Report\FullReport;
use App\Strategies\Report\FinancialReport;
use App\Strategies\Report\ReportStrategy;
use App\Factories\EventFactory;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Models\Guest;
use App\Models\Budget;



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

        EventFactory::create($request->category ?? 'geral', $data);


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

    public function generateReport($id, $type)
{
    $event = Event::findOrFail($id);

    switch ($type) {
        case 'summary':
            $strategy = new SummaryReport();
            break;
        case 'financial':
            $strategy = new FinancialReport();
            break;
        default:
            $strategy = new FullReport();
            break;
    }

    return $strategy->generate($event);
}

public function budget($id)
{
    $event = \App\Models\Event::findOrFail($id);
    $budgets = $event->budgets; // relação já existente

    return view('events.budget', compact('event', 'budgets'));
}



public function report($id)
{
    $event = Event::with(['guests', 'budgets'])->findOrFail($id);

    // Totais simples
    $totalGuests = $event->guests->count();
    $confirmedGuests = $event->guests->where('confirmed', true)->count();
    $totalBudget = $event->budgets->sum(function ($b) {
        return $b->price * $b->quantity;
    });

    // Exibir na tela antes de gerar o PDF
    return view('events.report', compact('event', 'totalGuests', 'confirmedGuests', 'totalBudget'));
}

public function downloadPDF($id)
{
    $event = Event::with(['guests', 'budgets'])->findOrFail($id);

    $totalGuests = $event->guests->count();
    $confirmedGuests = $event->guests->where('confirmed', true)->count();
    $totalBudget = $event->budgets->sum(function ($b) {
        return $b->price * $b->quantity;
    });

    $pdf = Pdf::loadView('events.report-pdf', compact('event', 'totalGuests', 'confirmedGuests', 'totalBudget'))
              ->setPaper('a4', 'portrait');

    return $pdf->download('relatorio_evento_'.$event->id.'.pdf');
}


}
