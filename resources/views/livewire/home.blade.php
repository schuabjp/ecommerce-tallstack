<div class="py-10"> {{-- Apenas espaçamento, sem recriar navbar --}}

    {{-- Banner Hero --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="bg-indigo-600 rounded-2xl p-8 md:p-12 text-center text-white shadow-xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Ofertas Imperdíveis</h1>
            <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
                A melhor tecnologia TALL Stack para o seu desenvolvimento.
            </p>
        </div>
    </div>

    {{-- Grid de Produtos --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Destaques da Semana</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div
                    class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden group">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 relative overflow-hidden">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                             class="object-cover w-full h-48 group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $product['name'] }}</h3>
                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $product['description'] }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span
                                class="text-xl font-bold text-indigo-600">R$ {{ number_format($product['price'], 2, ',', '.') }}</span>
                            <button
                                class="bg-gray-900 text-white px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                                Comprar
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
