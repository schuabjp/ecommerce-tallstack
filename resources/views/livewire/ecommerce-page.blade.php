<div x-data="{ showNotification: false, productName: '' }"
     @product-added.window="showNotification = true; productName = $event.detail.name; setTimeout(() => showNotification = false, 3000)"
     class="min-h-screen bg-gray-50">

    {{-- Notificação de produto adicionado --}}
    <div x-show="showNotification"
         x-transition
         class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <span x-text="productName"></span> adicionado ao carrinho!
    </div>

    {{-- Header/Navbar --}}
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">TechStore</span>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex space-x-8">
                    <a href="#produtos" class="text-gray-700 hover:text-indigo-600 transition">Produtos</a>
                    <a href="#sobre" class="text-gray-700 hover:text-indigo-600 transition">Sobre</a>
                    <a href="#contato" class="text-gray-700 hover:text-indigo-600 transition">Contato</a>
                </div>

                {{-- Cart & Mobile Menu --}}
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-700 hover:text-indigo-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @if(count($cart) > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ count($cart) }}
                            </span>
                        @endif
                    </button>

                    <button wire:click="toggleMobileMenu" class="md:hidden p-2">
                        @if($mobileMenuOpen)
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        @endif
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            @if($mobileMenuOpen)
                <div class="md:hidden py-4 border-t">
                    <a href="#produtos" class="block py-2 text-gray-700 hover:text-indigo-600">Produtos</a>
                    <a href="#sobre" class="block py-2 text-gray-700 hover:text-indigo-600">Sobre</a>
                    <a href="#contato" class="block py-2 text-gray-700 hover:text-indigo-600">Contato</a>
                </div>
            @endif
        </nav>
    </header>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Tecnologia de Ponta
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-indigo-100">
                    Os melhores produtos com os melhores preços
                </p>
                <a href="#produtos" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition transform hover:scale-105">
                    Ver Produtos
                </a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="inline-block p-4 bg-indigo-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Frete Grátis</h3>
                    <p class="text-gray-600">Em compras acima de R$ 299</p>
                </div>

                <div class="text-center p-6">
                    <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Compra Segura</h3>
                    <p class="text-gray-600">Seus dados protegidos</p>
                </div>

                <div class="text-center p-6">
                    <div class="inline-block p-4 bg-purple-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Parcele sem Juros</h3>
                    <p class="text-gray-600">Em até 12x no cartão</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Products Section --}}
    <section id="produtos" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Produtos em Destaque</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">
                        <img src="{{ $product['image'] }}"
                             alt="{{ $product['name'] }}"
                             class="w-full h-48 object-cover">

                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-600 text-sm rounded-full mb-2">
                                {{ $product['category'] }}
                            </span>
                            <h3 class="text-xl font-semibold mb-2">{{ $product['name'] }}</h3>

                            <div class="flex items-center mb-3">
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">{{ $product['rating'] }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600">
                                    R$ {{ number_format($product['price'], 2, ',', '.') }}
                                </span>
                                <button wire:click="addToCart({{ $product['id'] }})"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Cadastre-se e Ganhe 10% OFF</h2>
            <p class="text-xl mb-8 text-indigo-100">Na sua primeira compra!</p>

            <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row justify-center items-center gap-4 max-w-md mx-auto">
                <input wire:model="email"
                       type="email"
                       placeholder="Seu melhor e-mail"
                       class="w-full px-4 py-3 rounded-lg text-gray-900"
                       required>
                <button type="submit"
                        class="w-full sm:w-auto bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition whitespace-nowrap">
                    Cadastrar
                </button>
            </form>

            @if(session()->has('message'))
                <div class="mt-4 text-green-200">
                    {{ session('message') }}
                </div>
            @endif

            @error('email')
            <div class="mt-4 text-red-200">
                {{ $message }}
            </div>
            @enderror
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TechStore</h3>
                    <p class="text-gray-400">Sua loja de tecnologia online</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Links Úteis</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Sobre Nós</a></li>
                        <li><a href="#" class="hover:text-white transition">Política de Privacidade</a></li>
                        <li><a href="#" class="hover:text-white transition">Termos de Uso</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contato</h4>
                    <p class="text-gray-400">contato@techstore.com</p>
                    <p class="text-gray-400">(11) 1234-5678</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 TechStore. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</div>
