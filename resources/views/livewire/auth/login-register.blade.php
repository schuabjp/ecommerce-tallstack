<div class="min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    {{-- Container Centralizado --}}
    <div class="max-w-md w-full space-y-8">

        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            {{-- Cabeçalho do Card --}}
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isRegisterMode ? 'Criar Conta' : 'Acesse sua Conta' }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    {{ $isRegisterMode ? 'Preencha os dados abaixo' : 'Bem-vindo de volta' }}
                </p>
            </div>

            {{-- (Login/Registro) --}}
            @if(!$isRegisterMode)
                <form wire:submit="login" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" wire:model="email" id="email"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" wire:model="password" id="password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        Entrar
                    </button>
                </form>
            @else
                {{-- Formulário de Registro --}}
                <form wire:submit="register" class="space-y-4">
                    {{-- Campos de registro --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" wire:model="name"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg sm:text-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-indigo-700">
                        Criar Conta
                    </button>
                </form>
            @endif

            {{-- Botões de Navegação Auxiliares --}}
            <div class="mt-6 flex flex-col gap-3 text-center">
                <button wire:click="toggleMode" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    {{ $isRegisterMode ? 'Já tenho conta' : 'Não tenho conta ainda' }}
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
