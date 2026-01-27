<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';

    public $category_id = '';

    public $min_price = '';

    public $max_price = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryId()
    {
        $this->resetPage();
    }

    public function updatedMinPrice()
    {
        $this->resetPage();
    }

    public function updatedMaxPrice()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'Produto excluído.');
        }
    }

    public function render()
    {
        $query = Product::query()->with('category'); // Otimização

        // 1. Filtro de Texto
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // 2. Filtro de Categoria
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        // 3. Filtro de Preço Mínimo
        if ($this->min_price) {
            $query->where('price', '>=', $this->min_price);
        }

        // 4. Filtro de Preço Máximo
        if ($this->max_price) {
            $query->where('price', '<=', $this->max_price);
        }

        return view('livewire.product-list', [
            'products'   => $query->latest()->paginate(9),
            'categories' => Category::all(),
        ]);
    }
}
