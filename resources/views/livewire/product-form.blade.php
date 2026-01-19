<div class="max-w-4xl mx-auto py-12">
    
    {{-- Mensagem de Sucesso --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ $product ? 'Editar Produto' : 'Novo Produto' }}
        </h2>

        <form wire:submit="save">

            {{-- Nome --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Descrição --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Preço --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                    <input type="number" step="0.01" wire:model="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Categoria com Modal --}}
                <div class="mb-4" x-data="{ open: false }" x-on:category-created.window="open = false">
                    <label class="block text-sm font-medium text-gray-700">Categoria</label>
                    <div class="flex gap-2">
                        <select wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecione...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
            
                        {{-- Botão só aparece se for ADMIN --}}
                        @if(auth()->user()->role === 'admin') 
                            <button type="button" @click="open = true" class="mt-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition border border-gray-300 shadow-sm" title="Criar Nova Categoria">
                                +
                            </button>
                        @endif
                    </div>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            
                    {{-- JANELA MODAL (Só carrega se for Admin) --}}
                    @if(auth()->user()->role === 'admin')
                    <div x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                        <div class="bg-white p-6 rounded-lg shadow-xl w-96 border border-gray-200" @click.away="open = false">
                            <h3 class="text-lg font-bold mb-4 text-gray-800">Nova Categoria</h3>
                            
                            <div class="mb-3">
                                <label class="block text-xs text-gray-500 mb-1">Nome da Categoria</label>
                                <input type="text" wire:model="newCategoryName" class="w-full border-gray-300 rounded-md shadow-sm">
                                @error('newCategoryName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
            
                            <div class="mb-4">
                                <label class="block text-xs text-gray-500 mb-1">Cor da Etiqueta</label>
                                <div class="flex items-center gap-2">
                                    <input type="color" wire:model="newCategoryColor" class="h-10 w-20 p-0 border-0 rounded cursor-pointer">
                                    <span class="text-sm text-gray-600 font-mono" x-text="$wire.newCategoryColor"></span>
                                </div>
                            </div>
            
                            <div class="flex justify-end gap-2 mt-6">
                                <button type="button" @click="open = false" class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">Cancelar</button>
                                <button type="button" wire:click="createCategory" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center gap-2 shadow-md">
                                    <span wire:loading wire:target="createCategory" class="animate-spin">⌛</span>
                                    Salvar Categoria
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Upload de Imagem --}}
            <div class="border-t border-gray-100 pt-6 mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Imagem do Produto</label>
                <div class="flex items-start gap-6">
                    {{-- Preview --}}
                    <div class="relative w-32 h-32 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif ($product && $product->image)
                            <img src="{{ $product->image }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <div wire:loading wire:target="photo" class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <span class="text-white text-xs font-bold animate-pulse">Carregando...</span>
                        </div>
                    </div>

                    {{-- Input --}}
                    <div class="flex-1">
                        <input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG até 1MB.</p>
                        @error('photo') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Botões Finais --}}
            <div class="flex justify-end gap-4 border-t border-gray-200 pt-6">
                <a href="{{ route('products.index') }}" wire:navigate class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 shadow-sm transition">Cancelar</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 shadow-md transition">
                    {{ $product ? 'Salvar Alterações' : 'Criar Produto' }}
                </button>
            </div>

        </form>
    </div>
</div>