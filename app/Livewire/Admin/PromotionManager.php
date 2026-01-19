<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Enums\UserRole;
use Livewire\Component;
use Livewire\Attributes\Layout;
// 1. IMPORTANTE: Importar a Facade Auth para o VS Code não reclamar
use Illuminate\Support\Facades\Auth;

class PromotionManager extends Component
{
    public $product_id = '';
    public $discount_percentage = '';

    public function save()
    {
        // 2. CORREÇÃO: Usamos Auth::user() em vez de auth()->user()
        // O editor entende isso melhor.
        if (Auth::user()->role !== UserRole::ADMIN) {
            abort(403, 'Acesso negado.');
        }

        $this->validate([
            'product_id' => 'required|exists:products,id',
            'discount_percentage' => 'required|integer|min:1|max:90',
        ]);

        $product = Product::find($this->product_id);

        $product->update(['discount_percentage' => $this->discount_percentage]);
        $product->touch();

        session()->flash('message', "Promoção aplicada: {$product->name} com {$this->discount_percentage}% OFF!");
        $this->reset(['product_id', 'discount_percentage']);
    }

    public function remove($id)
    {
        // CORREÇÃO AQUI TAMBÉM
        if (Auth::user()->role !== UserRole::ADMIN) abort(403);

        Product::find($id)->update(['discount_percentage' => 0]);
        session()->flash('message', 'Promoção removida.');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.admin.promotion-manager', [
            'products' => Product::all(),
            'activePromotions' => Product::where('discount_percentage', '>', 0)
                ->latest('updated_at')
                ->get()
        ]);
    }
}
