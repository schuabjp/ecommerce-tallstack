<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    {{-- Cabeçalho da Dashboard --}}
    <div class="md:flex md:items-center md:justify-between mb-10">
        <div class="min-w-0 flex-1">
            <h2
                class="text-3xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-4xl sm:tracking-tight">
                Painel de Controle
            </h2>
            <p class="mt-1 text-gray-500 dark:text-gray-400">Gerencie sua conta, compras e preferências.</p>
        </div>
    </div>

    {{-- Grid de Cartões --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        {{-- CARD 1: Perfil do Usuário --}}
        <div
            class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-lg transition duration-300">
            <div class="px-6 py-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Sessão Atual</dt>
                <dd class="mt-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ auth()->user()->name }}
                </dd>
                <dd class="mt-1 text-sm text-gray-500 dark:text-gray-400 mb-4">
                    {{ auth()->user()->email }}
                </dd>
                <span
                    class="inline-flex items-center rounded-full bg-brand-50 dark:bg-brand-900/30 px-3 py-1 text-xs font-medium text-brand-700 dark:text-brand-300 ring-1 ring-inset ring-brand-700/10">
                    {{ auth()->user()->role->label() ?? 'Cliente' }}
                </span>
            </div>
        </div>

        {{-- CARD 2: Atalho para Loja (Catálogo) --}}
        <div
            class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-lg transition duration-300">
            <div class="px-6 py-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Ir às Compras
                </h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Acesse o catálogo completo para ver os produtos.</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" wire:navigate
                        class="inline-flex items-center rounded-lg bg-gray-900 dark:bg-white px-4 py-2 text-sm font-semibold text-white dark:text-gray-900 shadow-sm hover:opacity-90 transition">
                        Ver Produtos
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD 3: MEUS ENDEREÇOS (NOVO!) --}}
        <div
            class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-lg transition duration-300 relative group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <svg class="w-24 h-24 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div class="px-6 py-6 relative z-10">
                <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Endereços de Entrega
                </h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                    <p>Cadastre seus locais para agilizar a entrega.</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('addresses.index') }}" wire:navigate
                        class="inline-flex items-center rounded-lg bg-brand-600 text-white px-4 py-2 text-sm font-semibold hover:bg-brand-700 shadow-md shadow-brand-500/20 transition">
                        Gerenciar Endereços
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD 4: Sair (Logout) --}}
        <div
            class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-lg transition duration-300">
            <div class="px-6 py-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Encerrar Sessão
                </h3>
                <div class="mt-6">
                    <a href="{{ route('logout') }}"
                        class="inline-flex items-center rounded-lg bg-red-50 dark:bg-red-900/20 px-4 py-2 text-sm font-semibold text-red-600 dark:text-red-400 shadow-sm hover:bg-red-100 dark:hover:bg-red-900/40 transition">
                        Sair da Conta
                    </a>
                </div>
            </div>
        </div>

        {{-- ÁREA DO ADMIN (Só aparece se for Admin) --}}
        @if(auth()->user()->role->value === 'admin')
        <div class="col-span-full mt-4">
            <div
                class="bg-gradient-to-r from-brand-600 to-purple-600 overflow-hidden shadow-lg rounded-2xl border border-transparent relative">
                <div class="absolute right-0 top-0 h-full w-1/2 bg-white/10 transform skew-x-12"></div>

                <div class="px-6 py-8 flex flex-col sm:flex-row justify-between items-center gap-6 relative z-10">
                    <div class="text-white">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            ⚡ Central de Marketing
                        </h3>
                        <p class="text-brand-100 text-sm mt-1">Gerencie as promoções que aparecem na tela inicial.</p>
                    </div>
                    <a href="{{ route('admin.promotions') }}" wire:navigate
                        class="w-full sm:w-auto text-center bg-white text-brand-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-50 shadow-lg transition transform hover:scale-105">
                        Gerenciar Ofertas
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>