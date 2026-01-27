<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Início - E-commerce TALL')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            // Promoções
            'promotions' => Product::where('discount_percentage', '>', 0)
                ->latest('updated_at')->take(4)->get(),
            // Categorias para a Home
            'categories' => Category::withCount('products')->take(4)->get(),
            // Produtos Recentes
            'recent'     => Product::latest()->take(8)->get(),
        ]);
    }
}
