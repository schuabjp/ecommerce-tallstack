<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 min-h-screen">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Gestão de Categorias</h2>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Organize os seus produtos com etiquetas coloridas.</p>
    </div>

    {{-- Mensagem de Sucesso --}}
    @if (session()->has('message'))
    <div class="bg-green-100 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 mb-6 rounded shadow-sm"
        role="alert">
        <p>{{ session('message') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- COLUNA 1: FORMULÁRIO --}}
        <div class="md:col-span-1">
            <div
                class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl p-6 sticky top-24 border border-gray-100 dark:border-gray-800 transition-colors">
                <h3
                    class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-800 pb-2">
                    {{ $editingCategory ? 'Editar Categoria' : 'Nova Categoria' }}
                </h3>

                <form wire:submit="save" class="space-y-4">
                    {{-- Nome --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome</label>
                        <input type="text" wire:model="name" placeholder="Ex: Periféricos"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Cor --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cor da
                            Etiqueta</label>
                        <div class="flex items-center gap-2">
                            <input type="color" wire:model="color"
                                class="h-10 w-14 rounded cursor-pointer border-0 p-0 bg-transparent">
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $color }}</span>
                        </div>
                        @error('color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Botões --}}
                    <div class="flex justify-end pt-2 gap-2">
                        @if($editingCategory)
                        <button type="button" wire:click="cancel"
                            class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                            Cancelar
                        </button>
                        @endif
                        <button type="submit"
                            class="bg-brand-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-brand-700 transition shadow-lg shadow-brand-500/30">
                            {{ $editingCategory ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- COLUNA 2: LISTA (Ocupa 2/3) --}}
        <div class="md:col-span-2">
            <div
                class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 transition-colors">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Cor
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Nome
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                        @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-block w-6 h-6 rounded-full shadow-sm border border-gray-200 dark:border-gray-700"
                                    style="background-color: {{ $category->color }};"></span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $category->name }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $category->id }})"
                                    class="text-brand-600 dark:text-brand-400 hover:text-brand-900 dark:hover:text-brand-200 mr-4 font-semibold transition">
                                    Editar
                                </button>
                                <button wire:click="delete({{ $category->id }})"
                                    wire:confirm="Tem certeza? Os produtos ficarão 'Sem Categoria'."
                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-200 font-semibold transition">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                Nenhuma categoria encontrada. Crie a primeira ao lado! 🚀
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>