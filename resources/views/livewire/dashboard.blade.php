<div class="w-full max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden" wire:key="user-dashboard">

        {{-- Cabeçalho Personalizado --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-10 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Olá, {{ auth()->user()->name }}!
                </h1>
                <p class="text-blue-100 mt-1">
                    Bem-vindo de volta à loja.
                </p>
            </div>
            <button
                wire:click="logout"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-semibold transition backdrop-blur-sm"
            >
                Sair
            </button>
        </div>

        <div class="p-8">
            {{-- Seção de Produtos Exclusiva para Logados --}}
            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Produtos Disponíveis para Você</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition">
                        <div class="h-32 bg-gray-100 rounded-md mb-4 flex items-center justify-center text-gray-400">
                            [Imagem do Produto]
                        </div>
                        <h4 class="font-bold text-gray-900">{{ $product['name'] }}</h4>
                        <p class="text-indigo-600 font-bold mt-2">R$ {{ number_format($product['price'], 2, ',', '.') }}</p>
                        <button class="mt-3 w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 text-sm">
                            Comprar Agora
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
