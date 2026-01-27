<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 min-h-screen">

    {{-- Cabeçalho --}}
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Catálogo</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Explore nossa coleção completa.</p>
        </div>

        <div class="flex gap-3">
            @auth
            <a href="{{ route('products.create') }}" wire:navigate
                class="px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700 shadow-lg shadow-brand-500/30 transition flex items-center gap-2 text-sm font-bold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15">
                    </path>
                </svg>
                Novo Produto
            </a>
            @endauth
        </div>
    </div>

    {{-- BARRA DE FILTROS --}}
    <div
        class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 mb-10 transition-colors">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            {{-- Busca --}}
            <div class="md:col-span-1">
                <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 block">Buscar</label>
                <div class="relative">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Ex: Notebook..."
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 pl-10 transition-colors">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Categoria --}}
            <div class="md:col-span-1">
                <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 block">Categoria</label>
                <select wire:model.live="category_id"
                    class="w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 transition-colors">
                    <option value="">Todas</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Preço Mínimo --}}
            <div class="md:col-span-1">
                <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 block">Min (R$)</label>
                <input wire:model.live.debounce.500ms="min_price" type="number" placeholder="0"
                    class="w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 transition-colors">
            </div>

            {{-- Preço Máximo --}}
            <div class="md:col-span-1">
                <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 block">Máx (R$)</label>
                <input wire:model.live.debounce.500ms="max_price" type="number" placeholder="9999"
                    class="w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 transition-colors">
            </div>
        </div>
    </div>

    {{-- Grid de Produtos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($products as $product)
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col relative group">

            {{-- Etiqueta de Promoção --}}
            @if($product->discount_percentage > 0)
            <div
                class="absolute top-3 right-3 z-10 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg animate-pulse">
                -{{ $product->discount_percentage }}%
            </div>
            @endif

            {{-- Imagem --}}
            <div class="relative bg-gray-100 dark:bg-gray-800 aspect-[16/10] overflow-hidden">
                @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                    class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                @else
                <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-600">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                @endif

                {{-- Ações Overlay --}}
                @auth
                <div
                    class="absolute inset-0 bg-black/50 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition duration-300 backdrop-blur-sm">
                    <a href="{{ route('products.edit', $product->id) }}"
                        class="p-3 bg-white dark:bg-gray-800 rounded-full text-gray-900 dark:text-white hover:text-brand-600 hover:scale-110 transition shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </a>
                    <button wire:click="delete({{ $product->id }})" wire:confirm="Excluir produto?"
                        class="p-3 bg-white dark:bg-gray-800 rounded-full text-red-600 hover:bg-red-50 hover:scale-110 transition shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
                @endauth
            </div>

            {{-- Conteúdo --}}
            <div class="p-5 flex-1 flex flex-col">

                {{-- Categoria --}}
                <div class="mb-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border"
                        style="border-color: {{ $product->category->color ?? '#cbd5e1' }}40; background-color: {{ $product->category->color ?? '#f1f5f9' }}20; color: {{ $product->category->color ?? '#64748b' }}">
                        {{ $product->category->name ?? 'Geral' }}
                    </span>
                </div>

                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 leading-tight">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 flex-1">{{ $product->description }}
                </p>

                {{-- Preço --}}
                <div
                    class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    @if($product->discount_percentage > 0)
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-400 line-through">R$ {{ number_format($product->price, 2, ',',
                            '.') }}</span>
                        <span class="text-xl font-extrabold text-green-600 dark:text-green-400">
                            R$ {{ number_format($product->price * (1 - $product->discount_percentage/100), 2, ',', '.')
                            }}
                        </span>
                    </div>
                    @else
                    <span class="text-xl font-bold text-brand-600 dark:text-brand-400">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </span>
                    @endif

                    <button
                        class="text-brand-600 dark:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/30 p-2 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="inline-block p-4 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Nenhum produto encontrado</h3>
            <p class="text-gray-500 dark:text-gray-400">Tente ajustar os filtros.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $products->links() }}
    </div>
</div>