<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
    {{-- Cabeçalho da Página --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Catálogo de Produtos</h2>
        
        {{-- Botão "Novo Produto": Só aparece para Vendedor (Seller) ou Admin --}}
        @if(auth()->user()->role === \App\Enums\UserRole::SELLER || auth()->user()->role === \App\Enums\UserRole::ADMIN)
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Novo Produto
            </button>
        @endif
    </div>

    {{-- Área de Filtros --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="text-xs font-bold text-gray-500 uppercase">Buscar Nome</label>
            {{-- wire:model.live.debounce.300ms: Espera 300ms após parar de digitar para buscar (performance) --}}
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Ex: Placa de Vídeo" class="w-full border-gray-300 rounded-lg text-sm mt-1">
        </div>
        <div>
            <label class="text-xs font-bold text-gray-500 uppercase">Preço Mínimo</label>
            <input wire:model.live.blur="minPrice" type="number" placeholder="R$ 0,00" class="w-full border-gray-300 rounded-lg text-sm mt-1">
        </div>
        <div>
            <label class="text-xs font-bold text-gray-500 uppercase">Preço Máximo</label>
            <input wire:model.live.blur="maxPrice" type="number" placeholder="R$ 99999,00" class="w-full border-gray-300 rounded-lg text-sm mt-1">
        </div>
    </div>

    {{-- Grid de Produtos --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                {{-- Imagem --}}
                <div class="h-48 bg-gray-200 relative">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2 bg-white/90 px-2 py-1 rounded text-xs font-bold">
                        ID: {{ $product->id }}
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-gray-800 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $product->description }}</p>
                    
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-lg font-bold text-indigo-600">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                    </div>

                    {{-- Ações: Apenas Vendedor (Dono) ou Admin veem isso --}}
                    @if(auth()->user()->role === \App\Enums\UserRole::ADMIN || (auth()->user()->role === \App\Enums\UserRole::SELLER && auth()->user()->id === $product->user_id))
                        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
                            <button class="flex-1 bg-blue-50 text-blue-600 py-1.5 rounded text-xs font-bold hover:bg-blue-100">
                                Editar
                            </button>
                            <button 
                                wire:click="delete({{ $product->id }})"
                                wire:confirm="Tem certeza que deseja excluir este produto?"
                                class="flex-1 bg-red-50 text-red-600 py-1.5 rounded text-xs font-bold hover:bg-red-100">
                                Excluir
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Paginação (Links 1, 2, 3...) --}}
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>