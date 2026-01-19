<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    {{-- Cabeçalho --}}
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Minha Conta
            </h2>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Card 1: Perfil --}}
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Usuário Logado</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                    {{ auth()->user()->name }}
                </dd>
                <dd class="mt-2 text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </dd>
                <div class="mt-4">
                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                        {{ auth()->user()->role->label() }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Card 2: Atalho Loja (Padrão) --}}
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Ir para o Catálogo</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>Veja todos os produtos disponíveis.</p>
                </div>
                <div class="mt-5">
                    <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Ver Catálogo
                    </a>
                </div>
            </div>
        </div>

        {{-- Card 3: Sair --}}
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Sair do Sistema</h3>
                <div class="mt-5">
                    <a href="{{ route('logout') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                        Sair
                    </a>
                </div>
            </div>
        </div>

        {{-- ÁREA DO ADMIN: Card de Marketing (Só aparece para admin) --}}
        @if(auth()->user()->role->value === 'admin')
        <div class="col-span-full mt-4">
            <div class="bg-indigo-50 overflow-hidden shadow rounded-lg border border-indigo-100">
                <div class="px-4 py-5 sm:p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-indigo-900 flex items-center gap-2">
                            Área de Marketing
                        </h3>
                        <p class="text-indigo-700 text-sm mt-1">Gerencie as promoções que aparecem na tela inicial.</p>
                    </div>
                    <a href="{{ route('admin.promotions') }}" wire:navigate class="w-full sm:w-auto text-center bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 shadow transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.593l4.39-1.463a2.625 2.625 0 0 0 1.83-2.514V5.25A2.25 2.25 0 0 0 19.5 3h-4.318a1.875 1.875 0 0 0-1.325.548l-4.288 4.288" />
                        </svg>
                        Gerenciar Ofertas
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>