<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Gestão de Categorias</h2>
        <p class="text-gray-500 text-sm">Organize os seus produtos com etiquetas coloridas.</p>
    </div>

    {{-- Mensagem de Sucesso --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- COLUNA 1: FORMULÁRIO (Ocupa 1/3 da tela) --}}
        <div class="md:col-span-1">
            <div class="bg-white shadow-md rounded-lg p-6 sticky top-6">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">
                    {{ $editingCategory ? 'Editar Categoria' : 'Nova Categoria' }}
                </h3>

                <form wire:submit="save">
                    {{-- Nome --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" wire:model="name" placeholder="Ex: Periféricos" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Cor --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cor da Etiqueta</label>
                        <div class="flex items-center gap-3">
                            <input type="color" wire:model="color" class="h-10 w-14 p-0 border-0 rounded cursor-pointer shadow-sm">
                            <span class="text-gray-500 text-sm font-mono bg-gray-100 px-2 py-1 rounded">
                                {{ $color }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Essa cor aparecerá nos cards dos produtos.</p>
                        @error('color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Botões --}}
                    <div class="flex flex-col gap-2">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition flex justify-center items-center gap-2">
                            <span wire:loading wire:target="save" class="animate-spin">⌛</span>
                            {{ $editingCategory ? 'Atualizar' : 'Cadastrar' }}
                        </button>

                        @if($editingCategory)
                            <button type="button" wire:click="cancel" class="w-full bg-gray-100 text-gray-600 py-2 px-4 rounded-md hover:bg-gray-200 transition">
                                Cancelar Edição
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- COLUNA 2: LISTA (Ocupa 2/3 da tela) --}}
        <div class="md:col-span-2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Etiqueta</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition">
                                {{-- Visual da Etiqueta --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white shadow-sm" style="background-color: {{ $category->color }}">
                                        {{ $category->name }}
                                    </span>
                                </td>
                                
                                {{-- Nome Texto --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $category->name }}
                                </td>

                                {{-- Botões de Ação --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{ $category->id }})" class="text-indigo-600 hover:text-indigo-900 mr-4 font-semibold">
                                        Editar
                                    </button>
                                    <button wire:click="delete({{ $category->id }})" wire:confirm="Tem certeza? Os produtos dessa categoria ficarão 'Sem Categoria'." class="text-red-600 hover:text-red-900 font-semibold">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                    Nenhuma categoria encontrada. Use o formulário ao lado para criar a primeira! 🚀
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>