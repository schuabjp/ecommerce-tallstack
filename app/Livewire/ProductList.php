<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Catálogo de Produtos')]
class ProductList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'cat')]
    public string $category_id = '';

    #[Url(as: 'min')]
    public string $min_price = '';

    #[Url(as: 'max')]
    public string $max_price = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $product = Product::find($id);

        // Autorização simplificada (idealmente usar Policies)
        if ($product && Auth::check() && (Auth::user()->role->value === 'admin' || Auth::user()->id === $product->user_id)) {
            $product->delete();
        }
    }

    public function render(): View
    {
        $query = Product::query()->with('category');

        $query->when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"));
        $query->when($this->category_id, fn (Builder $q) => $q->where('category_id', $this->category_id));
        $query->when($this->min_price, fn (Builder $q) => $q->where('price', '>=', $this->min_price));
        $query->when($this->max_price, fn (Builder $q) => $q->where('price', '<=', $this->max_price));

        return view('livewire.product-list', [
            'products'   => $query->latest()->paginate(9),
            'categories' => Category::all(['id', 'name']),
        ]);
    }
}
