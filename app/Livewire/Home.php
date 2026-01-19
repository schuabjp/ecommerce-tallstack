<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product; // <--- Importante
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Início - E-commerce TALL')]
class Home extends Component
{
    public function render()
    {
        // Busca produtos com desconto
        $promotions = Product::where('discount_percentage', '>', 0)
            ->latest('updated_at')
            ->take(10)
            ->get();

        return view('livewire.home', [
            'promotions' => $promotions
        ]);
    }
}
