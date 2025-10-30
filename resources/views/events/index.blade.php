@extends('layouts.main')

@section('title', 'Meus Eventos')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Cabeçalho --}}
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800">📅 Meus Eventos</h1>
                <p class="text-gray-600 mt-1">Gerencie, edite ou acompanhe seus eventos.</p>
            </div>

            <a href="{{ route('events.create') }}"
               class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-md transition">
                + Criar Novo Evento
            </a>
        </div>

        {{-- Filtros --}}
        <form method="GET" class="mb-10 bg-white shadow-lg border border-gray-200 rounded-2xl p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Buscar por título ou local..."
                class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-indigo-400">

            <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-indigo-400">
                <option value="">Status</option>
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" @selected(($filters['status'] ?? '') == $status)>{{ $status }}</option>
                @endforeach
            </select>

            <select name="category" class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-indigo-400">
                <option value="">Categoria</option>
                @foreach($categoryOptions as $cat)
                    <option value="{{ $cat }}" @selected(($filters['category'] ?? '') == $cat)>{{ $cat }}</option>
                @endforeach
            </select>

            <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg px-4 py-2 transition shadow">
                Filtrar
            </button>
        </form>

        {{-- Cards --}}
        @if($events->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition overflow-hidden">

                {{-- Imagem --}}
                @if($event->image)
                    <img src="{{ asset('storage/'.$event->image) }}" class="h-44 w-full object-cover">
                @else
                    <div class="h-44 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <i class="fas fa-image text-4xl"></i>
                    </div>
                @endif

                <div class="p-6">
                    {{-- Título e Info --}}
                    <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>

                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="text-xs px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 font-medium">
                            {{ $event->category }}
                        </span>

                        <span class="text-xs px-3 py-1 rounded-full 
                            @if($event->status === 'Concluído') bg-green-100 text-green-700 
                            @elseif($event->status === 'Cancelado') bg-red-100 text-red-600
                            @elseif($event->status === 'Em andamento') bg-yellow-100 text-yellow-700
                            @else bg-gray-200 text-gray-600 @endif font-medium">
                            {{ $event->status }}
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm mt-3">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ date('d/m/Y', strtotime($event->date)) }}
                    </p>
                    <p class="text-gray-600 text-sm">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $event->location }}
                    </p>

                    {{-- Ações --}}
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a class="btn-outline" href="{{ route('events.edit', $event->id) }}">✏️ Editar</a>
                        <a class="btn-outline" href="{{ route('events.budget', $event->id) }}">💰 Orçamento</a>
                        <a class="btn-outline" href="{{ route('events.report', $event->id) }}">📄 Relatório</a>
                        <a class="btn-outline" href="{{ route('guests.index', $event->id) }}">🎟 Convidados</a>
                    </div>
                </div>

                {{-- Excluir --}}
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="border-t bg-gray-50 p-4 text-center">
                    @csrf @method('DELETE')
                    <button class="text-red-600 text-sm font-medium hover:underline">
                        🗑 Excluir Evento
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        {{-- Paginação --}}
        <div class="mt-10">
            {{ $events->links() }}
        </div>

        @else
        <p class="text-center text-gray-500 text-lg mt-10">
            Você ainda não possui eventos. Crie um agora ✨
        </p>
        @endif

    </div>
</div>
@endsection
