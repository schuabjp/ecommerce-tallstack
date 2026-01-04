<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\UserRole;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination; // Habilita paginação sem recarregar página

    // Filtros (conectados via wire:model no HTML)
    public $search = '';

    public $minPrice = '';

    public $maxPrice = '';

    // Reseta a paginação para a página 1 se o usuário digitar algo na busca
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Verifica se o usuário pode excluir (Admin ou Dono do produto)
        // Como ainda não criamos Policies complexas, vamos fazer uma verificação simples aqui
        if (Auth::user()->role === UserRole::ADMIN || Auth::user()->id === $product->user_id) {
            $product->delete();
        }
    }

    public function render()
    {
        $query = Product::query();

        // 1. Filtro de Nome
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // 2. Filtro de Preço Mínimo
        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }

        // 3. Filtro de Preço Máximo
        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        // Ordena por mais recente e pagina de 10 em 10
        return view('livewire.product-list', [
            'products' => $query->latest()->paginate(10),
        ]);
    }
}
