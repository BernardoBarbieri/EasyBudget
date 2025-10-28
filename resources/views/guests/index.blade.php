@extends('layouts.main')

@section('title', 'Convidados do Evento')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-indigo-50 py-16">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Cabeçalho --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-indigo-700 mb-2 tracking-tight">
                🎟️ Lista de Convidados
            </h1>
            <p class="text-gray-600 text-lg">
                Gerencie os convidados deste evento — cadastre, confirme presença e acompanhe o status.
            </p>

            <a href="{{ route('events.index') }}"
    class="inline-flex items-center gap-2 mt-6 bg-white text-gray-800 font-medium 
           px-6 py-2.5 rounded-xl border border-gray-200 shadow-md hover:bg-gray-50 
           hover:shadow-lg transition-all duration-200">
    <i class="fas fa-arrow-left text-indigo-600"></i>
    <span>Voltar aos Eventos</span>
</a>

        </div>

        {{-- Mensagem de sucesso --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-300 text-green-700 px-5 py-3 rounded-2xl mb-8 text-center font-medium shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Formulário de cadastro --}}
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 p-8 mb-14">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-indigo-500 via-blue-400 to-indigo-500"></div>

            <h2 class="text-2xl font-semibold text-indigo-700 mb-8 flex items-center gap-2">
                <i class="fas fa-user-plus text-indigo-600"></i> Adicionar Convidado
            </h2>

            <form method="POST" action="{{ route('guests.store', $event->id) }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Convidado</label>
                    <input type="text" name="name" required placeholder="Digite o nome"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition placeholder-gray-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail (opcional)</label>
                    <input type="email" name="email" placeholder="exemplo@email.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition placeholder-gray-400">
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 
                               text-white font-semibold px-6 py-2.5 rounded-xl shadow-md hover:shadow-indigo-300/50 
                               transition-all duration-200 w-full md:w-auto">
                        ➕ Adicionar
                    </button>
                </div>
            </form>
        </div>

        {{-- Lista de convidados --}}
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 p-8">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-blue-400"></div>

            <h2 class="text-2xl font-semibold text-indigo-700 mb-6 flex items-center gap-2">
                <i class="fas fa-users text-indigo-600"></i> Convidados Cadastrados
            </h2>

            @if($guests->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse rounded-2xl overflow-hidden shadow-sm">
                        <thead class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left rounded-tl-xl">Nome</th>
                                <th class="py-3 px-4 text-left">E-mail</th>
                                <th class="py-3 px-4 text-center">Status</th>
                                <th class="py-3 px-4 text-center rounded-tr-xl">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($guests as $guest)
                                <tr class="hover:bg-indigo-50 transition">
                                    <td class="py-3 px-4 font-medium text-gray-800">{{ $guest->name }}</td>
                                    <td class="py-3 px-4 text-gray-600">{{ $guest->email ?? '—' }}</td>
                                    <td class="py-3 px-4 text-center">
                                        @if($guest->confirmed)
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold shadow-sm">✅ Confirmado</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold shadow-sm">⏳ Pendente</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center flex justify-center gap-2">
                                        @if(!$guest->confirmed)
                                            <form method="POST" action="{{ route('guests.confirm', [$event->id, $guest->id]) }}">
                                                @csrf
                                               <button type="submit"
    class="inline-flex items-center gap-2 bg-white text-gray-800 font-medium px-4 py-1.5 rounded-lg 
           border border-gray-200 shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-200">
    <i class="fas fa-check text-green-600"></i>
    <span>Confirmar</span>
</button>

                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('guests.destroy', [$event->id, $guest->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir este convidado?')"
                                                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-1.5 rounded-lg shadow-md transition-all duration-150">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center text-gray-500 py-10">
                    <i class="fas fa-user-friends text-5xl text-indigo-300 mb-4"></i>
                    <p class="text-lg font-medium">Nenhum convidado cadastrado para este evento ainda.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

