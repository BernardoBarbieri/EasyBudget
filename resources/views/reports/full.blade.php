<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Completo - {{ $event->title }}</title></head>
<body>
  <h1>📄 Relatório Completo</h1>
  <p><strong>Título:</strong> {{ $event->title }}</p>
  <p><strong>Descrição:</strong> {{ $event->description }}</p>
  <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
  <p><strong>Local:</strong> {{ $event->location }}</p>
  <p><strong>Categoria:</strong> {{ $event->category ?? 'N/A' }}</p>

  <h3>💰 Orçamento</h3>
  @if($event->budgets && $event->budgets->count())
    <ul>
      @foreach($event->budgets as $b)
        <li>{{ $b->name }} — Qtd: {{ $b->quantity }} — R$ {{ number_format($b->price,2,',','.') }}</li>
      @endforeach
    </ul>
  @else
    <p>Sem itens cadastrados.</p>
  @endif
</body>
</html>
