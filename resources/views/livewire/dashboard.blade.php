<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    {{-- Cabeçalho --}}
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Minha Conta
            </h2>
        </div>
    </div>

    {{-- Grid de Cartões --}}
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
                        {{-- CORREÇÃO AQUI: Usamos o método label() do Enum --}}
                        {{ auth()->user()->role->label() }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Card 2: Atalho Loja --}}
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Ir para a Loja</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>Gerencie seus produtos e categorias.</p>
                </div>
                <div class="mt-5">
                    <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        Ver Produtos
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

    </div>
</div>