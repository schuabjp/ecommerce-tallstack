<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'E-commerce TALL' }}</title>

    {{-- Padronização de Fontes --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

{{-- Navbar Fixa --}}
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                {{-- Logo leva sempre para a Home --}}
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2">
                    <div class="bg-indigo-600 text-white p-1.5 rounded-lg font-bold text-xl">TS</div>
                    <span class="font-bold text-xl text-gray-900 tracking-tight">Loja TALL</span>
                </a>
            </div>

            <div class="flex items-center gap-4">
                {{-- Lógica de Botões da Navbar --}}
                @auth
                    <span class="text-sm text-gray-500 hidden sm:inline">Olá, {{ auth()->user()->name }}</span>
                    <a href="{{ route('dashboard') }}" wire:navigate
                       class="text-sm font-medium text-gray-700 hover:text-indigo-600">Minha Conta</a>
                @else
                    {{-- Se estiver na tela de login, não mostra botão de login, mostra "Voltar para Loja" --}}
                    @if(!request()->routeIs('login'))
                        <a href="{{ route('login') }}" wire:navigate
                           class="text-sm font-medium text-gray-700 hover:text-indigo-600">Entrar</a>
                        <a href="{{ route('login') }}" wire:navigate
                           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                            Criar Conta
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Conteúdo Dinâmico --}}
<main class="flex-1 w-full">
    {{ $slot }}
</main>

{{-- Rodapé Padrão --}}
<footer class="bg-white border-t border-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} E-commerce TALL Stack.
    </div>
</footer>

</body>
</html>
