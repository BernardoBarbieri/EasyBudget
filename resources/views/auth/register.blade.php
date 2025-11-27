<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div class="mt-4">
    <label for="terms" class="inline-flex items-center">
        <input id="terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="terms" required>
        <span class="ms-2 text-sm text-gray-600">
            Li e aceito os <a href="javascript:void(0)" onclick="openModal()" class="underline text-indigo-600 hover:text-indigo-900 font-bold">Termos de Uso e Política de Privacidade</a>.
        </span>
    </label>
</div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <div id="termsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Termos de Uso e Política de Privacidade
                        </h3>
                        <div class="mt-2 h-64 overflow-y-auto text-sm text-gray-500 border p-2 rounded bg-gray-50">
                            <p class="font-bold mt-2">1. Aceitação</p>
                            <p>Ao utilizar o sistema EasyBudget, você concorda com a coleta e processamento de seus dados para fins de gestão de eventos.</p>
                            
                            <p class="font-bold mt-2">2. Coleta de Dados (LGPD)</p>
                            <p>Coletamos apenas dados essenciais (Nome e E-mail) para autenticação. Seus dados são armazenados de forma segura e não são compartilhados com terceiros.</p>

                            <p class="font-bold mt-2">3. Responsabilidades</p>
                            <p>O usuário é responsável pela veracidade das informações inseridas nos orçamentos e listas de convidados.</p>

                            <p class="font-bold mt-2">4. Uso Acadêmico</p>
                            <p>Este sistema é um projeto acadêmico sem fins lucrativos. Não há garantia de disponibilidade permanente do serviço.</p>
                            
                            <p class="font-bold mt-2">5. Consentimento</p>
                            <p>Ao clicar em "Registrar", você confirma que leu e compreendeu estes termos.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Entendi e Aceito
                </button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('termsModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('termsModal').classList.add('hidden');
        // Opcional: Marca o checkbox automaticamente ao fechar
        document.getElementById('terms').checked = true;
    }
</script>

</x-guest-layout>
