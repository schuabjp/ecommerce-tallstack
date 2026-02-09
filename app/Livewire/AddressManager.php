<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Meus Endereços')]
class AddressManager extends Component
{
    public ?int $address_id = null;

    #[Validate('nullable|string|max:50')]
    public string $name = '';

    #[Validate('required|string|min:8|max:9')]
    public string $cep = '';

    #[Validate('required|string')]
    public string $street = '';

    #[Validate('required|string')]
    public string $number = '';

    #[Validate('nullable|string')]
    public string $complement = '';

    #[Validate('required|string')]
    public string $neighborhood = '';

    #[Validate('required|string')]
    public string $city = '';

    #[Validate('required|string|size:2')]
    public string $state = '';

    public bool $isModalOpen = false;

    // Hook: Roda quando o CEP é atualizado
    public function updatedCep(string $value): void
    {
        $cep = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cep) === 8) {
            $response = Http::timeout(3)->get("https://viacep.com.br/ws/{$cep}/json/");

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

    public function save(): void
    {
        $this->validate();

        $data = [
            'name'         => $this->name,
            'cep'          => $this->cep,
            'street'       => $this->street,
            'number'       => $this->number,
            'complement'   => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city'         => $this->city,
            'state'        => $this->state,
        ];

        if ($this->address_id) {
            $address = Auth::user()->addresses()->findOrFail($this->address_id);
            $address->update($data);
            session()->flash('message', 'Endereço atualizado!');
        } else {
            Auth::user()->addresses()->create($data);
            session()->flash('message', 'Endereço cadastrado!');
        }

        $this->closeModal();
    }

    public function edit(int $id): void
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        $this->address_id = $address->id;
        $this->name = $address->name ?? '';
        $this->cep = $address->cep;
        $this->street = $address->street;
        $this->number = $address->number;
        $this->complement = $address->complement ?? '';
        $this->neighborhood = $address->neighborhood;
        $this->city = $address->city;
        $this->state = $address->state;

        $this->openModal();
    }

    public function delete(int $id): void
    {
        Auth::user()->addresses()->where('id', $id)->delete();
        session()->flash('message', 'Endereço removido.');
    }

    public function openModal(): void
    {
        $this->resetValidation();
        $this->isModalOpen = true;
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->reset(['address_id', 'name', 'cep', 'street', 'number', 'complement', 'neighborhood', 'city', 'state']);
    }

    public function render(): View
    {
        return view('livewire.address-manager', [
            'addresses' => Auth::user()->addresses()->latest()->get(),
        ]);
    }
}
