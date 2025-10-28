<?php

namespace App\Strategies\Report;

interface ReportStrategy
{
    public function generate($event);
}
