<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'E-commerce TALL' }}</title>

    {{-- Fontes --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Tailwind + Configuração --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#eef2ff', 
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc', 
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5', 
                            700: '#4338ca', 
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Script Anti-Flicker do Dark Mode --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Animação personalizada para o fundo do Login */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>
</head>

<body
    class="bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300 antialiased flex flex-col min-h-screen">

    {{-- Navbar --}}
    <nav
        class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- Logo --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 group">
                        <div
                            class="bg-brand-600 text-white p-2 rounded-lg group-hover:rotate-12 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">Loja<span
                                class="text-brand-600">TALL</span></span>
                    </a>
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" wire:navigate
                        class="text-sm font-medium hover:text-brand-600 dark:hover:text-brand-400 transition {{ request()->routeIs('home') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-gray-300' }}">Início</a>
                    <a href="{{ route('products.index') }}" wire:navigate
                        class="text-sm font-medium hover:text-brand-600 dark:hover:text-brand-400 transition {{ request()->routeIs('products.*') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-gray-300' }}">Catálogo</a>
                    <a href="{{ route('categories.index') }}" wire:navigate
                        class="text-sm font-medium hover:text-brand-600 dark:hover:text-brand-400 transition {{ request()->routeIs('categories.*') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-gray-300' }}">Categorias</a>
                </div>

                {{-- Ações Direita --}}
                <div class="flex items-center gap-4">

                    {{-- Botão Dark Mode --}}
                    <button x-data="{ 
                            darkMode: localStorage.getItem('theme') === 'dark' 
                        }" @click="
                            darkMode = !darkMode; 
                            localStorage.setItem('theme', darkMode ? 'dark' : 'light');
                            if (darkMode) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        "
                        class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-600 dark:text-yellow-400"
                        title="Alternar Tema">
                        {{-- Ícone Lua (Modo Claro) --}}
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        {{-- Ícone Sol (Modo Escuro) --}}
                        <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 text-sm font-medium hover:text-brand-600 dark:hover:text-brand-400 transition text-gray-700 dark:text-gray-200">
                            <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff"
                                class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800">
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50 border border-gray-100 dark:border-gray-700">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">Sair</a>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" wire:navigate
                        class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2 rounded-full text-sm font-medium transition shadow-lg shadow-brand-500/30">
                        Entrar
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Conteúdo Principal --}}
    <main class="flex-1 w-full relative">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer
        class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-12 py-12 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">Loja<span
                            class="text-brand-600">TALL</span></span>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm max-w-xs">
                        A melhor tecnologia para o seu setup. Produtos selecionados com garantia e qualidade.
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Links Rápidos</h3>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li><a href="#" class="hover:text-brand-600">Sobre Nós</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-brand-600">Produtos</a></li>
                        <li><a href="#" class="hover:text-brand-600">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Newsletter</h3>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Seu e-mail"
                            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-sm focus:border-brand-500 focus:ring-brand-500">
                        <button
                            class="bg-brand-600 text-white px-3 py-2 rounded-md text-sm hover:bg-brand-700 transition">OK</button>
                    </form>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-800 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} E-commerce TALL. Todos os direitos reservados.
            </div>
        </div>
    </footer>

</body>

</html>