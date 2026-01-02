<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ $product ? 'Editar Produto' : 'Cadastrar Novo Produto' }}
        </h2>

        <form wire:submit="save" class="space-y-6">

            {{-- Nome --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                <input type="text" wire:model="name" class="w-full border-gray-300 rounded-lg shadow-sm">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Preço --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                <input type="number" step="0.01" wire:model="price" class="w-full border-gray-300 rounded-lg shadow-sm">
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Descrição --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea wire:model="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    Cancelar
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Salvando...
                </button>
            </div>
        </form>
    </div>
</div>