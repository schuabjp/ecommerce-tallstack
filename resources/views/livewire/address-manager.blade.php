<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 min-h-screen">

    {{-- Cabeçalho --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Meus Endereços</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Gerencie seus locais de entrega.</p>
        </div>

        <button wire:click="openModal"
            class="px-6 py-2 bg-brand-600 text-white rounded-xl font-bold hover:bg-brand-700 shadow-lg shadow-brand-500/30 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
            Adicionar Endereço
        </button>
    </div>

    {{-- Feedback de Sucesso --}}
    @if (session()->has('message'))
    <div
        class="bg-green-100 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 mb-6 rounded shadow-sm flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        {{ session('message') }}
    </div>
    @endif

    {{-- Grid de Endereços --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($addresses as $address)
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg transition p-6 relative group">
            <div class="flex justify-between items-start mb-4">
                <div class="bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="flex gap-2">
                    <button wire:click="edit({{ $address->id }})"
                        class="text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 transition" title="Editar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </button>
                    <button wire:click="delete({{ $address->id }})"
                        wire:confirm="Tem certeza que deseja excluir este endereço?"
                        class="text-gray-400 hover:text-red-600 transition" title="Excluir">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">
                {{ $address->name ?? 'Minha Casa' }}
            </h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                {{ $address->street }}, {{ $address->number }} <br>
                {{ $address->neighborhood }} - {{ $address->city }}/{{ $address->state }} <br>
                CEP: {{ $address->cep }}
            </p>
        </div>
        @empty
        <div
            class="col-span-full py-12 text-center border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-2xl">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Nenhum endereço cadastrado</h3>
            <p class="text-gray-500 dark:text-gray-400">Clique no botão acima para adicionar o primeiro.</p>
        </div>
        @endforelse
    </div>

    {{-- MODAL --}}
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 bg-gray-900/75 transition-opacity backdrop-blur-sm" wire:click="closeModal"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white dark:bg-gray-900 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100 dark:border-gray-800">
                <div class="bg-white dark:bg-gray-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-100 dark:border-gray-800 pb-3"
                        id="modal-title">
                        {{ $address_id ? 'Editar Endereço' : 'Novo Endereço' }}
                    </h3>

                    <form wire:submit="save" class="space-y-5">

                        {{-- Apelido --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Nome do Local
                                (Opcional)</label>
                            <input type="text" wire:model="name" placeholder="Ex: Casa, Trabalho, Casa da Mãe..."
                                class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                        </div>

                        {{-- CEP (Com Loading) --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">CEP</label>
                                <div class="relative">
                                    <input type="text" wire:model.live.debounce.500ms="cep" placeholder="00000000"
                                        maxlength="9"
                                        class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                                    {{-- Spinner de Loading --}}
                                    <div wire:loading wire:target="cep" class="absolute right-3 top-4">
                                        <svg class="animate-spin h-5 w-5 text-brand-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('cep') <span class="text-red-500 text-xs font-semibold">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Estado
                                    (UF)</label>
                                <input type="text" wire:model="state" readonly
                                    class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800/50 text-gray-500 dark:text-gray-400 cursor-not-allowed font-semibold">
                            </div>
                        </div>

                        {{-- Cidade e Bairro --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Cidade</label>
                                <input type="text" wire:model="city" readonly
                                    class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800/50 text-gray-500 dark:text-gray-400 cursor-not-allowed font-semibold">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Bairro</label>
                                <input type="text" wire:model="neighborhood"
                                    class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                            </div>
                        </div>

                        {{-- Rua --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Rua /
                                Logradouro</label>
                            <input type="text" wire:model="street"
                                class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                        </div>

                        {{-- Numero e Complemento --}}
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Número</label>
                                <input type="text" wire:model="number" id="numberField"
                                    class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                                @error('number') <span class="text-red-500 text-xs font-semibold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300">Complemento</label>
                                <input type="text" wire:model="complement"
                                    class="w-full mt-1 rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-brand-500 focus:ring-brand-500 transition">
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Footer do Modal --}}
                <div
                    class="bg-gray-50 dark:bg-gray-800/50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse gap-3 border-t border-gray-100 dark:border-gray-800">
                    <button wire:click="save" type="button"
                        class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg shadow-brand-500/30 px-5 py-2.5 bg-brand-600 text-base font-bold text-white hover:bg-brand-700 focus:outline-none sm:w-auto sm:text-sm transition">
                        Salvar Endereço
                    </button>
                    <button wire:click="closeModal" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-5 py-2.5 bg-white dark:bg-gray-800 text-base font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm transition">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
       @this.on('cep-found', () => {
           setTimeout(() => { document.getElementById('numberField').focus(); }, 100);
       });
    });
</script>