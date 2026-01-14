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

            {{-- Categoria --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Categoria</label>

                <select wire:model="category_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecione uma categoria...</option>

                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach

                </select>

                @error('category_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Descrição --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea wire:model="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            {{-- CAMPO DE IMAGEM --}}
            <div class="border-t border-gray-100 pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Imagem do Produto</label>

                <div class="flex items-center gap-6">

                    {{-- ÁREA DE PREVIEW (Visualização) --}}
                    <div class="relative w-32 h-32 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        @if ($photo)
                        {{-- Caso 1: Usuário acabou de selecionar uma foto nova (Preview Temporário) --}}
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-green-500 text-white text-xs text-center py-1">
                            Nova Imagem
                        </div>

                        @elseif ($product && $product->image)
                        {{-- Caso 2: Edição (Mostra a foto que já está no banco) --}}
                        <img src="{{ $product->image }}" class="w-full h-full object-cover">

                        @else
                        {{-- Caso 3: Nenhuma foto --}}
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif

                        {{-- Loading State (Mostra enquanto faz o upload) --}}
                        <div wire:loading wire:target="photo"
                            class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <span class="text-white text-xs font-bold animate-pulse">Carregando...</span>
                        </div>
                    </div>

                    {{-- INPUT DE ARQUIVO --}}
                    <div class="flex-1">
                        <input type="file" wire:model="photo" accept="image/png, image/jpeg, image/jpg"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG até 1MB.</p>
                        @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            {{-- Botões --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    Cancelar
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>