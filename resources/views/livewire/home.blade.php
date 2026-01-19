<div class="py-10 bg-gray-50 min-h-screen">

    {{-- Banner Hero (Mantive o seu, só ajustei cores) --}}
    <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="bg-indigo-900 rounded-2xl p-8 md:p-12 text-center text-white shadow-xl bg-[url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80')] bg-cover bg-center bg-blend-multiply">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">Ofertas Imperdíveis</h1>
            <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
                As melhores promoções selecionadas para você.
            </p>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-indigo-900 font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-lg transform hover:scale-105">
                Ver Catálogo Completo
            </a>
        </div>
    </div>

    {{-- Grid de Promoções (2 Linhas x 5 Colunas) --}}
    <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            Destaques em Promoção
        </h2>

        {{-- GRID RESPONSIVO: 
             Celular: 1 coluna
             Tablet: 2 colunas
             Laptop: 4 colunas
             Tela Grande (XL): 5 colunas (Como você pediu) 
        --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse($promotions as $product)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group relative flex flex-col">

                {{-- Etiqueta de Desconto --}}
                <div class="absolute top-3 right-3 z-10 bg-red-600 text-white text-xs font-black px-2 py-1 rounded shadow animate-pulse">
                    -{{ $product->discount_percentage }}%
                </div>

                {{-- Imagem --}}
                <div class="aspect-w-16 aspect-h-10 bg-gray-200 overflow-hidden h-48 w-full">
                    @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="object-cover w-full h-full group-hover:scale-110 transition duration-700">
                    @else
                    <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">Sem Foto</div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-5 flex-1 flex flex-col">
                    <div class="text-xs text-indigo-500 font-bold uppercase mb-1">{{ $product->category->name ?? 'Oferta' }}</div>
                    <h3 class="text-md font-bold text-gray-900 leading-tight mb-2 line-clamp-2" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h3>

                    {{-- Preços --}}
                    <div class="mt-auto">
                        <div class="flex items-end gap-2">
                            <span class="text-xs text-gray-400 line-through mb-1">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </span>
                            <span class="text-xl font-extrabold text-green-600">
                                R$ {{ number_format($product->price * (1 - $product->discount_percentage/100), 2, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
                <p class="text-gray-500 text-lg">Nenhuma promoção ativa no momento. Volte em breve! 🕒</p>
            </div>
            @endforelse
        </div>
    </div>
</div>