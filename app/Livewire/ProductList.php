<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination; // <--- Não esqueça de importar

class ProductList extends Component
{
    use WithPagination;

    public $search = '';

    public $category_id = ''; // Filtro de categoria

    // Reinicia a paginação quando filtra
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryId()
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
        $query = Product::query();

        // Filtro de Texto
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Filtro de Categoria
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        return view('livewire.product-list', [
            'products'   => $query->latest()->paginate(9),
            // Passamos as categorias para preencher o select de filtro
            'categories' => Category::all(),
        ]);
    }
}
