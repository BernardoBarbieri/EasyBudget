<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório do Evento - {{ $event->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; margin: 40px; }
        h1 { color: #4F46E5; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Relatório do Evento</h1>
    <h2>{{ $event->name }}</h2>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
    <p><strong>Descrição:</strong> {{ $event->description }}</p>

    <h3>Resumo</h3>
    <ul>
        <li><strong>Total de Convidados:</strong> {{ $totalGuests }}</li>
        <li><strong>Confirmados:</strong> {{ $confirmedGuests }}</li>
        <li><strong>Total de Orçamento:</strong> R$ {{ number_format($totalBudget, 2, ',', '.') }}</li>
    </ul>
</body>
</html>
