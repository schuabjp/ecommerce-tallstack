<div class="max-w-5xl mx-auto py-12 px-4">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">⚡ Gerenciar Vitrine de Ofertas</h2>
        <p class="text-gray-500">Selecione produtos para aparecerem na Home Page com desconto.</p>
    </div>

    {{-- Formulário de Cadastro --}}
    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-200 text-green-700 p-3 rounded mb-4 font-medium">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit="save" class="flex flex-col md:flex-row gap-4 items-end">
            {{-- Select Produto --}}
            <div class="flex-1 w-full">
                <label class="block text-sm font-bold text-gray-700 mb-1">Escolha o Produto</label>
                <select wire:model="product_id" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 shadow-sm">
                    <option value="">Selecione...</option>
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->name }} (Atual: R$ {{ number_format($p->price, 2, ',', '.') }})
                    </option>
                    @endforeach
                </select>
                @error('product_id') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>

            {{-- Input Porcentagem --}}
            <div class="w-full md:w-40">
                <label class="block text-sm font-bold text-gray-700 mb-1">% Desconto</label>
                <div class="relative">
                    <input type="number" wire:model="discount_percentage" min="1" max="90" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 shadow-sm pl-3 pr-8" placeholder="20">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 font-bold">%</span>
                    </div>
                </div>
                @error('discount_percentage') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>

            {{-- Botão Salvar --}}
            <button type="submit" class="w-full md:w-auto bg-indigo-600 text-white font-bold py-2.5 px-6 rounded-lg hover:bg-indigo-700 transition shadow-md flex items-center justify-center gap-2">
                <span wire:loading.remove>Aplicar Oferta</span>
                <span wire:loading>Salvando...</span>
            </button>
        </form>
    </div>

    {{-- Tabela de Promoções Ativas --}}
    <h3 class="font-bold text-gray-800 mb-4 pl-1 border-l-4 border-green-500">Ofertas Ativas na Home</h3>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Produto</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Preço Original</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Desconto</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Preço Final</th>
                    <th class="px-6 py-3 text-right">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($activePromotions as $promo)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $promo->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 line-through">R$ {{ number_format($promo->price, 2, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-green-600 bg-green-50 w-min rounded">{{ $promo->discount_percentage }}%</td>
                    <td class="px-6 py-4 text-sm font-bold text-indigo-900">
                        R$ {{ number_format($promo->price * (1 - $promo->discount_percentage/100), 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="remove({{ $promo->id }})" wire:confirm="Remover este produto da promoção?" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase tracking-wider border border-red-200 px-3 py-1 rounded hover:bg-red-50 transition">
                            Remover
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                        Nenhuma promoção cadastrada no momento.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>