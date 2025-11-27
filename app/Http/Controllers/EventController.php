<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;     
use App\Models\Event;
use App\Models\Guest;
use App\Models\Budget;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Strategies\Report\SummaryReport;
use App\Strategies\Report\FullReport;
use App\Strategies\Report\FinancialReport;
use App\Strategies\Report\ReportStrategy;
use App\Factories\EventFactory;



class EventController extends Controller
{

public function index(Request $request)
{
    $userId = auth()->id();

    // Filtros vindos da querystring
    $q        = $request->get('q');
    $status   = $request->get('status');
    $category = $request->get('category');
    $from     = $request->get('from');   // yyyy-mm-dd
    $to       = $request->get('to');     // yyyy-mm-dd
    $sort     = $request->get('sort', 'date_desc'); // date_desc | date_asc
    $perPage  = (int) $request->get('perPage', 9);

    $query = Event::where('user_id', $userId);

    // Busca livre por título/local
    if (!empty($q)) {
        $query->where(function ($sub) use ($q) {
            $sub->where('title', 'like', "%{$q}%")
                ->orWhere('location', 'like', "%{$q}%");
        });
    }

    // Filtro de status
    if (!empty($status)) {
        $query->where('status', $status);
    }

    // Filtro de categoria
    if (!empty($category)) {
        $query->where('category', $category);
    }

    // Intervalo de datas
    if (!empty($from)) {
        $query->whereDate('date', '>=', $from);
    }
    if (!empty($to)) {
        $query->whereDate('date', '<=', $to);
    }

    // Ordenação
    if ($sort === 'date_asc') {
        $query->orderBy('date', 'asc');
    } else {
        $query->orderBy('date', 'desc');
    }

    // Contadores úteis
    $events = $query
        ->withCount([
            'guests',
            'guests as guests_confirmed_count' => function ($q) {
                $q->where('confirmed', true);
            },
            'budgets'
        ])
        ->paginate($perPage)
        ->withQueryString();

    // Opções de selects (pode vir do banco/config se preferir)
    $statusOptions = ['Planejado', 'Em andamento', 'Concluído', 'Cancelado'];
    $categoryOptions = [
        'Casamento', 'Aniversário', 'Corporativo',
        'Religioso', 'Social', 'Acadêmico', 'Outros'
    ];

    $filters = compact('q', 'status', 'category', 'from', 'to', 'sort', 'perPage');

    return view('events.index', compact('events', 'filters', 'statusOptions', 'categoryOptions'));
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
