<?php

namespace App\Strategies\Report;

use Barryvdh\DomPDF\Facade\Pdf;

class FinancialReport implements ReportStrategy
{
    public function generate($event)
    {
        $pdf = Pdf::loadView('reports.financial', compact('event'));
        return $pdf->download('relatorio_financeiro.pdf');
    }
}
