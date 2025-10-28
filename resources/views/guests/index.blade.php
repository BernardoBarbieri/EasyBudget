@extends('layouts.app')

@section('title', 'Convidados do Evento')

@section('content')
<div class="container">
    <h2>🎟️ Convidados de {{ $event->title }}</h2>

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px;border-radius:5px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulário --}}
    <div class="card" style="padding:20px; margin-bottom:20px;">
        <h4>Adicionar Convidado</h4>
        <form action="{{ route('guests.store', $event->id) }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nome do convidado" required
                   style="padding:8px;width:45%;margin-right:10px;border-radius:5px;border:1px solid #ccc;">
            <input type="email" name="email" placeholder="E-mail (opcional)"
                   style="padding:8px;width:45%;border-radius:5px;border:1px solid #ccc;">
            <button class="btn btn-primary" style="margin-top:10px;">Adicionar</button>
        </form>
    </div>

    {{-- Lista de convidados --}}
    @if($event->guests->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Presença</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($event->guests as $guest)
                    <tr>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->email ?? '-' }}</td>
                        <td>
                            @if($guest->confirmed)
                                ✅ Confirmado
                            @else
                                ❌ Aguardando
                            @endif
                        </td>
                        <td>
                            @if(!$guest->confirmed)
                                <form action="{{ route('guests.confirm', $guest->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Confirmar</button>
                                </form>
                            @endif
                            <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum convidado cadastrado ainda.</p>
    @endif
</div>
@endsection
