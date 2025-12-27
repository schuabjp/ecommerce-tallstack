<div class="min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    {{-- Elemento Root Único do Livewire --}}
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

            {{-- Exibição Geral de Erros --}}
            @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 text-sm border border-red-100">
                <p class="font-bold mb-1">Verifique os erros abaixo:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- MODO LOGIN --}}
            @if(!$isRegisterMode)
            <form wire:submit="login" class="space-y-6">
                <div>
                    <label for="login_email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" id="login_email" wire:model.blur="email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="seu@email.com">
                </div>
                <div>
                    <label for="login_password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" id="login_password" wire:model.blur="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="••••••••">
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Entrar</span>
                    <span wire:loading>Validando...</span>
                </button>
            </form>

            {{-- MODO REGISTRO (COMPLETO) --}}
            @else
            <form wire:submit="register" class="space-y-4">

                {{-- Campo: Nome Completo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                    <input type="text" wire:model.blur="name"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="Ex: João da Silva">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Campo: Tipo de Conta --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Eu quero:</label>
                    {{-- wire:model.live é ESSENCIAL aqui para atualizar o label do documento em tempo real --}}
                    <select wire:model.live="role"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="customer">Comprar (Cliente)</option>
                        <option value="seller">Vender (Vendedor)</option>
                    </select>
                </div>

                {{-- Campo UNIFICADO: Documento --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        {{ $role === 'seller' ? 'CPF ou CNPJ' : 'CPF' }}
                    </label>

                    <input type="text" wire:model.blur="document" maxlength="18"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="{{ $role === 'seller' ? 'Apenas números' : '000.000.000-00' }}">
                    @error('document') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Campo: E-mail --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" wire:model.blur="email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="seu@email.com">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Campo: Senha --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" wire:model.blur="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="Mínimo 8 caracteres">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Campo: Confirmar Senha --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                    <input type="password" wire:model.blur="password_confirmation"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        placeholder="Repita a senha">
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition shadow-sm mt-4 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Finalizar Cadastro</span>
                    <span wire:loading>Salvando...</span>
                </button>
            </form>
            @endif

            {{-- Botões de Navegação Auxiliares --}}
            <div class="mt-6 flex flex-col gap-3 text-center border-t border-gray-100 pt-6">
                <button wire:click="toggleMode"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition">
                    {{ $isRegisterMode ? 'Já tenho conta? Fazer Login' : 'Não tem conta? Criar conta nova' }}
                </button>

                <a href="{{ route('home') }}" wire:navigate
                    class="text-sm text-gray-500 hover:text-gray-700 flex items-center justify-center gap-1 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Voltar para a Loja
                </a>
            </div>
        </div>
    </div>
</div>