<div class="min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8" wire:key="auth-container">

        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            {{-- Cabeçalho do Card --}}
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isRegisterMode ? 'Criar Nova Conta' : 'Acesse sua Conta' }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    {{ $isRegisterMode ? 'Preencha os dados completos abaixo' : 'Bem-vindo de volta à Loja TALL' }}
                </p>
            </div>

            {{-- ALERTAS DE ERRO GERAIS --}}
            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 text-sm">
                    <p class="font-bold">Ops! Algo deu errado:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!$isRegisterMode)
                <form wire:submit="login" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" wire:model.blur="email" id="email"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="seu@email.com">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" wire:model.blur="password" id="password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>

                    <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        <span wire:loading.remove>Entrar</span>
                        <span wire:loading>Entrando...</span>
                    </button>
                </form>
            @else
                <form wire:submit="register" class="space-y-4">

                    {{-- Campo: Nome Completo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                        <input type="text" wire:model.blur="name"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Ex: João da Silva">
                    </div>

                    {{-- Campo: CPF --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">CPF</label>
                        {{-- wire:model.live permite formatar enquanto digita se quiser implementar máscara JS depois --}}
                        <input type="text" wire:model.blur="cpf" maxlength="14"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="000.000.000-00">
                        <p class="text-xs text-gray-500 mt-1">Somente números ou com pontuação.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" wire:model.blur="email"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="seu@email.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" wire:model.blur="password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Mínimo 8 caracteres">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                        <input type="password" wire:model.blur="password_confirmation"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Repita a senha">
                    </div>

                    <button type="submit"
                            class="w-full bg-green-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition shadow-sm mt-4">
                        <span wire:loading.remove>Finalizar Cadastro</span>
                        <span wire:loading>Salvando...</span>
                    </button>
                </form>
            @endif

            <div class="mt-6 flex flex-col gap-3 text-center border-t pt-6">
                <button wire:click="toggleMode" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    {{ $isRegisterMode ? 'Já tenho conta? Fazer Login' : 'Não tem conta? Criar conta nova' }}
                </button>

                <a href="{{ route('home') }}" wire:navigate
                   class="text-sm text-gray-500 hover:text-gray-700 flex items-center justify-center gap-1 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Voltar para a Loja
                </a>
            </div>
        </div>
    </div>
</div>
