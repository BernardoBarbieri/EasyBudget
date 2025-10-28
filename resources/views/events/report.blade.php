@extends('layouts.main')

@section('title', 'Relatório do Evento')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 py-12">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-3xl p-10 border border-gray-100">

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-extrabold text-indigo-700 flex items-center gap-3">
                📊 Relatório do Evento
            </h1>
            <a href="{{ route('events.index') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-md transition-all duration-200">
                ← Voltar
            </a>
        </div>

        <div class="mb-10">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $event->name }}</h2>
            <p class="text-gray-500 mt-1">Data: {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
            <p class="text-gray-600 mt-3 leading-relaxed">{{ $event->description }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center mb-10">
            <div class="bg-indigo-50 p-6 rounded-2xl shadow-sm border border-indigo-100">
                <p class="text-gray-600 font-medium">Total de Convidados</p>
                <h3 class="text-3xl font-extrabold text-indigo-700 mt-2">{{ $totalGuests }}</h3>
            </div>
            <div class="bg-green-50 p-6 rounded-2xl shadow-sm border border-green-100">
                <p class="text-gray-600 font-medium">Confirmados</p>
                <h3 class="text-3xl font-extrabold text-green-600 mt-2">{{ $confirmedGuests }}</h3>
            </div>
            <div class="bg-yellow-50 p-6 rounded-2xl shadow-sm border border-yellow-100">
                <p class="text-gray-600 font-medium">Total do Orçamento</p>
                <h3 class="text-3xl font-extrabold text-yellow-600 mt-2">R$ {{ number_format($totalBudget, 2, ',', '.') }}</h3>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('events.report.pdf', $event->id) }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl shadow-md transition-all duration-200">
               📄 Gerar PDF
            </a>
        </div>

    </div>
</div>
@endsection
