<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    {{-- Título da Página --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $product ? 'Editar Produto' : 'Cadastrar Novo Produto' }}
        </h2>
        <p class="text-sm text-gray-500">Preencha as informações abaixo para exibir o produto na loja.</p>
    </div>

    {{-- Mensagem de Sucesso (Feedback) --}}
    @if (session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                </svg></div>
            <div>
                <p class="font-bold">Sucesso!</p>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <form wire:submit="save" class="p-6 sm:p-8 space-y-6">

            {{-- 1. Nome do Produto --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nome do Produto</label>
                <input type="text" wire:model="name" placeholder="Ex: Notebook Gamer Dell"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out">
                @error('name') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- 2. Categoria (A Correção Importante) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Categoria</label>
                <div class="relative">
                    <select wire:model="category_id"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                        <option value="">Selecione uma categoria...</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    {{-- Ícone da setinha para ficar bonito --}}
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Selecione a categoria para ativar os filtros na loja.</p>
                @error('category_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- 3. Preço e Desconto (Grid de 2 colunas) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Preço --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Preço (R$)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">R$</span>
                        </div>
                        <input type="number" step="0.01" wire:model="price" placeholder="0.00"
                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    @error('price') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- 4. Descrição --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Descrição Detalhada</label>
                <textarea wire:model="description" rows="4" placeholder="Descreva as características do produto..."
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('description') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- 5. Upload de Imagem --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Imagem do Produto</label>

                <div
                    class="flex items-center gap-6 p-4 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition">

                    {{-- Área de Preview --}}
                    <div
                        class="relative h-32 w-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                        @if ($photo)
                        {{-- Preview da Nova Imagem (Upload) --}}
                        <img src="{{ $photo->temporaryUrl() }}" class="h-full w-full object-cover">
                        @elseif ($product && $product->image)
                        {{-- Imagem Existente (Edição) --}}
                        <img src="{{ $product->image }}" class="h-full w-full object-cover">
                        @else
                        {{-- Placeholder --}}
                        <div class="flex items-center justify-center h-full text-gray-400 flex-col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="text-xs">Sem foto</span>
                        </div>
                        @endif

                        {{-- Loading Spinner (Upload em andamento) --}}
                        <div wire:loading wire:target="photo"
                            class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    {{-- Input File --}}
                    <div class="flex-1">
                        <input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-indigo-50 file:text-indigo-700
                                      hover:file:bg-indigo-100 cursor-pointer">
                        <p class="mt-2 text-xs text-gray-500">
                            Recomendado: Imagens quadradas ou retangulares (JPG, PNG). Máximo 1MB.
                        </p>
                        @error('photo') <span class="text-red-500 text-xs font-semibold block mt-1">{{ $message
                            }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Botões de Ação --}}
            <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6 mt-6">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 shadow-sm transition duration-150">
                    Cancelar
                </a>

                <button type="submit"
                    class="px-8 py-2.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-md transition duration-150 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Salvar Produto</span>
                    <span wire:loading>
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Salvando...
                    </span>
                </button>
            </div>

        </form>
    </div>
</div>