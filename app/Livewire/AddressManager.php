<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Meus Endereços')]
class AddressManager extends Component
{
    public $addresses;

    // Variáveis do Formulário
    public $address_id = null;

    public $name = '';

    public $cep = '';

    public $street = '';

    public $number = '';

    public $complement = '';

    public $neighborhood = '';

    public $city = '';

    public $state = '';

    public $isModalOpen = false;

    // Regras de validação
    protected $rules = [
        'name'         => 'nullable|string|max:50',
        'cep'          => 'required|string|min:8|max:9',
        'street'       => 'required|string',
        'number'       => 'required|string',
        'neighborhood' => 'required|string',
        'city'         => 'required|string',
        'state'        => 'required|string|size:2',
    ];

    public function render()
    {
        // Carrega os endereços do usuário logado
        $this->addresses = Auth::user()->addresses()->latest()->get();

        return view('livewire.address-manager');
    }

    // --- MÁGICA DO VIACEP ---
    // Essa função roda automaticamente sempre que o campo CEP é alterado
    public function updatedCep($value)
    {
        // Remove traços e pontos, deixa só números
        $cep = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cep) === 8) {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->successful() && ! isset($response['erro'])) {
                $data = $response->json();

                $this->street = $data['logradouro'] ?? '';
                $this->neighborhood = $data['bairro'] ?? '';
                $this->city = $data['localidade'] ?? '';
                $this->state = $data['uf'] ?? '';

                $this->dispatch('cep-found');
            }
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->address_id) {
            // Edição
            $address = Address::find($this->address_id);

            // Segurança: garantir que o endereço pertence ao usuário
            if ($address->user_id !== Auth::id()) {
                abort(403);
            }

            $address->update([
                'name'         => $this->name,
                'cep'          => $this->cep,
                'street'       => $this->street,
                'number'       => $this->number,
                'complement'   => $this->complement,
                'neighborhood' => $this->neighborhood,
                'city'         => $this->city,
                'state'        => $this->state,
            ]);
            session()->flash('message', 'Endereço atualizado!');
        } else {
            // Criação
            Auth::user()->addresses()->create([
                'name'         => $this->name,
                'cep'          => $this->cep,
                'street'       => $this->street,
                'number'       => $this->number,
                'complement'   => $this->complement,
                'neighborhood' => $this->neighborhood,
                'city'         => $this->city,
                'state'        => $this->state,
            ]);
            session()->flash('message', 'Endereço cadastrado com sucesso!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $address = Address::find($id);

        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $this->address_id = $address->id;
        $this->name = $address->name;
        $this->cep = $address->cep;
        $this->street = $address->street;
        $this->number = $address->number;
        $this->complement = $address->complement;
        $this->neighborhood = $address->neighborhood;
        $this->city = $address->city;
        $this->state = $address->state;

        $this->openModal();
    }

    public function delete($id)
    {
        $address = Address::find($id);

        if ($address && $address->user_id === Auth::id()) {
            $address->delete();
            session()->flash('message', 'Endereço removido.');
        }
    }

    public function openModal()
    {
        $this->isModalOpen = true;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['address_id', 'name', 'cep', 'street', 'number', 'complement', 'neighborhood', 'city', 'state']);
    }
}
