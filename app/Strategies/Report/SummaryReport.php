<?php

namespace App\Strategies\Report;

use Barryvdh\DomPDF\Facade\Pdf;

class SummaryReport implements ReportStrategy
{
    public function generate($event)
    {
        $pdf = Pdf::loadView('reports.summary', compact('event'));
        return $pdf->download('relatorio_resumo.pdf');
    }
}
