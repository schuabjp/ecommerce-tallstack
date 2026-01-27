<div class="overflow-x-hidden">

    {{-- 1. HERO SECTION (Com gradiente animado) --}}
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-brand-900/90 to-purple-900/90"></div>

        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-brand-500/20 text-brand-300 text-sm font-semibold mb-6 animate-pulse border border-brand-500/30">
                🚀 Novas Ofertas Disponíveis
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                Tecnologia que <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-purple-400">Transforma</span>
            </h1>
            <p class="mt-4 text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                Encontre os melhores equipamentos para o seu setup. Qualidade, garantia e entrega rápida para todo o
                Brasil.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="px-8 py-4 bg-white text-brand-900 font-bold rounded-full hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                    Ver Catálogo
                </a>
                <a href="#promocoes"
                    class="px-8 py-4 bg-brand-600 text-white font-bold rounded-full hover:bg-brand-700 transition transform hover:scale-105 shadow-lg shadow-brand-600/30">
                    Ofertas do Dia
                </a>
            </div>
        </div>
    </div>

    {{-- 2. FEATURES (Ícones) --}}
    <div class="py-12 bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-900 transition duration-300 group">
                    <div
                        class="w-12 h-12 mx-auto bg-brand-100 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white">Garantia de Qualidade</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Todos os produtos verificados e originais.
                    </p>
                </div>
                <div class="p-6 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-900 transition duration-300 group">
                    <div
                        class="w-12 h-12 mx-auto bg-brand-100 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white">Entrega Rápida</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Enviamos para todo o país em tempo recorde.
                    </p>
                </div>
                <div class="p-6 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-900 transition duration-300 group">
                    <div
                        class="w-12 h-12 mx-auto bg-brand-100 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white">Pagamento Seguro</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Parcelamento e proteção de dados.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. CATEGORIAS --}}
    <div class="py-16 bg-gray-50 dark:bg-gray-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Navegue por Categorias</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category_id' => $cat->id]) }}" wire:navigate
                    class="group relative overflow-hidden rounded-2xl aspect-[4/3] bg-white dark:bg-gray-800 shadow-sm hover:shadow-xl transition duration-300 flex flex-col items-center justify-center border border-gray-100 dark:border-gray-700">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 z-10">
                    </div>
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 transition transform group-hover:-translate-y-2"
                        style="background-color: {{ $cat->color }}20; color: {{ $cat->color }}">
                        <span class="font-bold text-2xl" style="color: {{ $cat->color }}">{{ substr($cat->name, 0, 1)
                            }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-white relative z-20 transition">
                        {{ $cat->name }}</h3>
                    <span
                        class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-gray-200 relative z-20 transition">{{
                        $cat->products_count }} Produtos</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 4. PROMOÇÕES (Com Grid Melhorado) --}}
    <div id="promocoes" class="py-16 bg-white dark:bg-gray-950 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">🔥 Ofertas Relâmpago</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Preços baixos por tempo limitado.</p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="text-brand-600 dark:text-brand-400 font-semibold hover:underline">Ver tudo &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($promotions as $product)
                <div
                    class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300 overflow-hidden group relative flex flex-col h-full">

                    {{-- Tag --}}
                    <div
                        class="absolute top-3 right-3 z-10 bg-red-500 text-white text-[10px] font-black px-2 py-1 rounded shadow animate-pulse">
                        -{{ $product->discount_percentage }}%
                    </div>

                    {{-- Imagem --}}
                    <div class="relative bg-gray-100 dark:bg-gray-800 aspect-[4/3] overflow-hidden">
                        @if($product->image)
                        <img src="{{ $product->image }}"
                            class="object-cover w-full h-full group-hover:scale-110 transition duration-700">
                        @else
                        <div class="flex items-center justify-center h-full w-full text-gray-300 dark:text-gray-600">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="text-xs font-bold uppercase mb-1"
                            style="color: {{ $product->category->color ?? '#6366f1' }}">
                            {{ $product->category->name ?? 'Geral' }}
                        </div>
                        <h3 class="font-bold text-gray-900 dark:text-white leading-tight mb-2 line-clamp-2">
                            {{ $product->name }}
                        </h3>

                        <div
                            class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center">
                            <div>
                                <span class="block text-xs text-gray-400 line-through">R$ {{
                                    number_format($product->price, 2, ',', '.') }}</span>
                                <span class="text-lg font-extrabold text-green-600 dark:text-green-400">
                                    R$ {{ number_format($product->price * (1 - $product->discount_percentage/100), 2,
                                    ',', '.') }}
                                </span>
                            </div>
                            <button
                                class="bg-brand-600 text-white p-2 rounded-lg hover:bg-brand-700 transition shadow-lg shadow-brand-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500 dark:text-gray-400">Nenhuma promoção ativa no momento.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>