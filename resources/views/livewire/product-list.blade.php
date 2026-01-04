<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- 1. Cabeçalho e Botão de Novo Produto --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">
            Catálogo de Produtos
        </h2>

        {{-- LÓGICA DE PERMISSÃO:
        Só mostramos o botão se for Vendedor (Seller) ou Admin. O Cliente (Customer) não vê isso.--}}
        @if(auth()->user()->role === \App\Enums\UserRole::SELLER || auth()->user()->role === \App\Enums\UserRole::ADMIN)
        <a href="{{ route('products.create') }}" wire:navigate
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2 font-medium shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Novo Produto
        </a>
        @endif
    </div>

    {{-- 2. Mensagem de Sucesso --}}
    @if (session()->has('message'))
    <div
        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
        <div>
            <p class="font-bold">Sucesso!</p>
            <p>{{ session('message') }}</p>
        </div>
        <span class="text-2xl">&times;</span>
    </div>
    @endif

    {{-- 3. Área de Filtros --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Busca por Nome --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Buscar Produto</label>
                <div class="relative">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Ex: Processador..."
                        class="w-full border-gray-300 rounded-lg text-sm pl-9 focus:ring-indigo-500 focus:border-indigo-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Preço Mínimo --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Preço Mínimo</label>
                <input wire:model.live.blur="minPrice" type="number" placeholder="R$ 0,00"
                    class="w-full border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Preço Máximo --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Preço Máximo</label>
                <input wire:model.live.blur="maxPrice" type="number" placeholder="R$ 99999,00"
                    class="w-full border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
    </div>

    {{-- 4. Grid de Produtos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div
            class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">

            {{-- Imagem do Produto --}}
            <div class="h-48 bg-gray-100 relative group overflow-hidden">
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                {{-- Badge de Usuário (Opcional: mostra quem vendeu) --}}
                <div
                    class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold text-gray-600 shadow-sm">
                    Cód: {{ $product->id }}
                </div>
            </div>

            {{-- Conteúdo do Card --}}
            <div class="p-4 flex flex-col flex-1">
                <h3 class="font-bold text-gray-800 text-lg mb-1 leading-tight truncate" title="{{ $product->name }}">
                    {{ $product->name }}
                </h3>

                <p class="text-gray-500 text-xs mb-4 line-clamp-2 flex-1">
                    {{ $product->description }}
                </p>

                <div class="mt-auto">
                    <div class="flex items-end justify-between mb-4">
                        <span class="text-xs text-gray-500">Preço à vista</span>
                        <span class="text-xl font-bold text-indigo-600">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </span>
                    </div>

                    {{-- AÇÕES: Editar e Excluir --}}
                    {{-- Logica: Admin vê tudo. Vendedor vê só os seus. Cliente não vê nada. --}}
                    @if(auth()->user()->role === \App\Enums\UserRole::ADMIN || (auth()->user()->role ===
                    \App\Enums\UserRole::SELLER && auth()->user()->id === $product->user_id))
                    <div class="grid grid-cols-2 gap-2 pt-3 border-t border-gray-100">

                        {{-- Link para EDITAR (Rota com ID) --}}
                        <a href="{{ route('products.edit', $product->id) }}" wire:navigate
                            class="flex items-center justify-center gap-1 bg-blue-50 text-blue-600 py-2 rounded-lg text-xs font-bold hover:bg-blue-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar
                        </a>

                        {{-- Botão EXCLUIR (Com confirmação nativa do Livewire) --}}
                        <button wire:click="delete({{ $product->id }})"
                            wire:confirm="AÇÃO IRREVERSÍVEL: Tem certeza absoluta que deseja excluir o produto '{{ $product->name }}'?"
                            class="flex items-center justify-center gap-1 bg-red-50 text-red-600 py-2 rounded-lg text-xs font-bold hover:bg-red-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Excluir
                        </button>
                    </div>
                    @else
                    {{-- Botão para Cliente (Apenas visual, sem link por enquanto) --}}
                    <button
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition">
                        Adicionar ao Carrinho
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        {{-- Estado Vazio (Caso não ache produtos) --}}
        <div class="col-span-full text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900">Nenhum produto encontrado</h3>
            <p class="text-gray-500">Tente ajustar seus filtros ou cadastre um novo produto.</p>
        </div>
        @endforelse
    </div>

    {{-- 5. Paginação --}}
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>