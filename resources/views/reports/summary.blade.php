<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Resumo - {{ $event->title }}</title></head>
<body>
  <h1>📋 Relatório Resumido</h1>
  <p><strong>Título:</strong> {{ $event->title }}</p>
  <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
  <p><strong>Local:</strong> {{ $event->location }}</p>
  <p><strong>Categoria:</strong> {{ $event->category ?? 'N/A' }}</p>
</body>
</html>
