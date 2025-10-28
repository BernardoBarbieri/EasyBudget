@extends('layouts.main')

@section('title', 'Configurações da Conta - Easy Budget')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Cabeçalho --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl shadow-lg p-8 mb-10">
            <h1 class="text-3xl font-bold mb-2">⚙️ Configurações da Conta</h1>
            <p class="text-blue-100 text-base">Gerencie suas informações pessoais, credenciais e preferências de segurança.</p>
            <div class="mt-4">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition font-medium">
                    <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
                </a>
            </div>
        </div>

        {{-- Grid Principal --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Dados Pessoais --}}
            <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 hover:shadow-xl transition-all">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-3 mb-3">
                    <i class="fas fa-user-circle text-blue-600 text-2xl"></i>
                    Dados Pessoais
                </h2>
                <p class="text-gray-500 text-sm mb-6">Atualize seu nome e e-mail associados à conta.</p>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <div class="flex justify-end">
    <button type="submit"
        class="inline-flex items-center gap-2 bg-white text-gray-800 font-semibold px-6 py-3 
               rounded-lg border border-gray-200 shadow-sm hover:bg-gray-50 hover:shadow-md 
               transition-all duration-200">
        <i class="fas fa-save text-blue-600"></i>
        <span>Salvar Alterações</span>
    </button>
</div>

                </form>
            </div>

            {{-- Alterar Senha --}}
            <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 hover:shadow-xl transition-all">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-3 mb-3">
                    <i class="fas fa-lock text-blue-600 text-2xl"></i>
                    Segurança e Senha
                </h2>
                <p class="text-gray-500 text-sm mb-6">Defina uma senha forte para manter sua conta protegida.</p>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Senha Atual</label>
                        <input type="password" name="current_password"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Digite sua senha atual">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nova Senha</label>
                        <input type="password" name="password"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Crie uma nova senha">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Repita sua nova senha">
                    </div>

                    <div class="flex justify-end">
    <button type="submit"
        class="inline-flex items-center gap-2 bg-white text-gray-800 font-semibold px-6 py-3 
               rounded-lg border border-gray-200 shadow-sm hover:bg-gray-50 hover:shadow-md 
               transition-all duration-200">
        <i class="fas fa-key text-indigo-600"></i>
        <span>Atualizar Senha</span>
    </button>
</div>

                </form>
            </div>
        </div>

        {{-- Excluir Conta --}}
        <div class="bg-white rounded-2xl shadow-md p-8 border border-red-200 hover:shadow-xl transition-all mt-10">
            <h2 class="text-2xl font-semibold text-red-600 flex items-center gap-3 mb-3">
                <i class="fas fa-user-times text-red-500 text-2xl"></i>
                Exclusão de Conta
            </h2>
            <p class="text-gray-600 text-sm mb-6">
                Esta ação é permanente e removerá todos os seus dados.
            </p>

            <p class="text-gray-700 mb-6 leading-relaxed">
                ⚠️ <strong>Atenção:</strong> ao excluir sua conta, todos os seus <strong>eventos</strong>, <strong>orçamentos</strong> e <strong>convidados</strong> serão removidos definitivamente.  
                Recomendamos que você baixe ou anote suas informações antes de continuar.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não poderá ser desfeita.')">
                @csrf
                @method('delete')

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                    🗑️ Excluir Minha Conta Permanentemente
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
