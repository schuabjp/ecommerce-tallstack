<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative">

    {{-- Efeitos de Fundo --}}
    <div
        class="absolute top-0 left-1/4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob dark:bg-purple-900 dark:mix-blend-normal">
    </div>
    <div
        class="absolute top-0 right-1/4 w-72 h-72 bg-brand-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 dark:bg-brand-900 dark:mix-blend-normal">
    </div>

    <div class="max-w-md w-full space-y-8 relative z-10" wire:key="auth-container">

        <div
            class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700">

            {{-- Cabeçalho --}}
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.131A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.85.591-4.162m0 0A9.015 9.015 0 0112 3c1.929 0 3.716.46 5.341 1.252">
                        </path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    {{ $isRegisterMode ? 'Criar Conta' : 'Bem-vindo' }}
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ $isRegisterMode ? 'Junte-se a nós hoje mesmo' : 'Acesse para gerenciar suas compras' }}
                </p>
            </div>

            @if ($errors->any())
            <div
                class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 p-4 rounded-xl mb-6 text-sm border border-red-100 dark:border-red-800 animate-pulse">
                <p class="font-bold mb-1">Atenção:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- LOGIN FORM --}}
            @if (!$isRegisterMode)
            <form wire:submit="login" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">E-mail</label>
                    <input type="email" wire:model="email"
                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Senha</label>
                    <input type="password" wire:model="password"
                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                </div>

                <button type="submit"
                    class="w-full bg-brand-600 text-white py-3 rounded-xl font-bold hover:bg-brand-700 transition shadow-lg shadow-brand-500/30 transform hover:-translate-y-0.5">
                    <span wire:loading.remove>Entrar no Sistema</span>
                    <span wire:loading>Validando...</span>
                </button>
            </form>

            {{-- REGISTER FORM --}}
            @else
            <form wire:submit="register" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Conta</label>
                        <select wire:model.live="role"
                            class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                            <option value="customer">Sou Cliente</option>
                            <option value="seller">Sou Vendedor</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome Completo</label>
                        <input type="text" wire:model="name"
                            class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
                        <input type="email" wire:model="email"
                            class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">CPF /
                            Documento</label>
                        <input type="text" wire:model="document"
                            class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
                        <input type="password" wire:model="password"
                            class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar
                            Senha</label>
                        <input type="password" wire:model="password_confirmation"
                            class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded-xl font-bold hover:bg-green-700 transition shadow-lg shadow-green-500/30 transform hover:-translate-y-0.5 mt-4">
                    <span wire:loading.remove>Criar Conta</span>
                    <span wire:loading>Salvando...</span>
                </button>
            </form>
            @endif

            <div class="mt-8 text-center">
                <button wire:click="toggleMode"
                    class="text-sm font-medium text-brand-600 dark:text-brand-400 hover:text-brand-800 dark:hover:text-brand-300 transition underline underline-offset-4">
                    {{ $isRegisterMode ? 'Já tenho conta? Fazer Login' : 'Não tem conta? Cadastre-se grátis' }}
                </button>
            </div>
        </div>
    </div>
</div>