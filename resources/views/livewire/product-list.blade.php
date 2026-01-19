<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    {{-- Cabeçalho da Página --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">
            Catálogo de Produtos
        </h2>

        <div class="flex gap-3">
            {{-- BOTÃO 1: Gerenciar Categorias (Novo) --}}
            {{-- Removi o @if do admin para garantir que você veja o botão --}}
            <a href="{{ route('categories.index') }}" wire:navigate class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 shadow-sm transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.593l4.39-1.463a2.625 2.625 0 001.83-2.514V5.25A2.25 2.25 0 0019.5 3h-4.318a1.875 1.875 0 00-1.325.548l-4.288 4.288" />
                </svg>
                Categorias
            </a>

            {{-- BOTÃO 2: Novo Produto --}}
            <a href="{{ route('products.create') }}" wire:navigate class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 shadow-md transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Novo Produto
            </a>
        </div>
    </div>

    {{-- Filtros e Busca --}}
    <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Buscar produtos..." 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>
        <div class="w-full md:w-64">
            <select wire:model.live="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Todas as Categorias</option>
                {{-- O loop de categorias precisa vir do Componente --}}
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Grid de Produtos --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                {{-- Imagem --}}
                <div class="h-48 bg-gray-200 relative group">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">Sem Imagem</div>
                    @endif
                    
                    {{-- Ações Rápidas (aparecem ao passar o mouse) --}}
                    <div class="absolute inset-0 bg-black/40 hidden group-hover:flex items-center justify-center gap-2 transition">
                        <a href="{{ route('products.edit', $product) }}" class="p-2 bg-white rounded-full hover:bg-gray-100 text-indigo-600" title="Editar">
                            ✏️
                        </a>
                        <button wire:click="delete({{ $product->id }})" wire:confirm="Tem certeza?" class="p-2 bg-white rounded-full hover:bg-gray-100 text-red-600" title="Excluir">
                            🗑️
                        </button>
                    </div>
                </div>

                {{-- Conteúdo --}}
                <div class="p-4 flex-1 flex flex-col">
                    {{-- Badge da Categoria --}}
                    @if($product->category)
                        <div class="mb-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full text-white" 
                                  style="background-color: {{ $product->category->color }}">
                                {{ $product->category->name }}
                            </span>
                        </div>
                    @endif

                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">{{ $product->description }}</p>
                    
                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-bold text-indigo-600">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Nenhum produto encontrado. Que tal criar um?
            </div>
        @endforelse
    </div>

    {{-- Paginação --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>