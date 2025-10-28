<?php

namespace App\Strategies\Report;

use Barryvdh\DomPDF\Facade\Pdf;

class FullReport implements ReportStrategy
{
    public function generate($event)
    {
        $pdf = Pdf::loadView('reports.full', compact('event'));
        return $pdf->download('relatorio_completo.pdf');
    }
}
