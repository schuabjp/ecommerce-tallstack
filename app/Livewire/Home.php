<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Início - Loja TALL')]
class Home extends Component
{
    public function render(): View
    {
        return view('livewire.home', [
            'promotions' => Product::with('category')
                ->where('discount_percentage', '>', 0)
                ->latest('updated_at')
                ->take(4)
                ->get(),

            'categories' => Category::withCount('products')
                ->take(4)
                ->get(),

            'recent'     => Product::with('category')
                ->latest()
                ->take(8)
                ->get(),
        ]);
    }
}
