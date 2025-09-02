<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Exibe o relatório do evento na tela
     */
    public function show($id)
    {
        $event = Event::with('budgets')->findOrFail($id);
        return view('reports.show', compact('event'));
    }

    /**
     * Gera o PDF do relatório do evento
     */
    public function generatePDF($id)
    {
        $event = Event::with('budgets')->findOrFail($id);

        // Gera o PDF a partir da view reports/show.blade.php
        $pdf = Pdf::loadView('reports.show', compact('event'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('relatorio-evento-' . $event->id . '.pdf');
    }
}
