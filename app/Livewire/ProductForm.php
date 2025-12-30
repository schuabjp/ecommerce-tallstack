<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Produto')]
class ProductForm extends Component
{
    // Se tiver ID, é edição. Se for null, é criação.
    public ?Product $product = null;

    public $name = '';
    public $description = '';
    public $price = '';

    public function mount(Product $product = null)
    {
        if ($product && $product->exists) {
            $this->product = $product;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
        }
    }

    public function save()
    {
        // Validação
        $this->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
        ]);

        // Se $this->product existe, atualiza ele. Se não, cria um novo.
        if ($this->product && $this->product->exists) {
            // MODO EDIÇÃO
            // Verifica se o usuário é admin ou criador do produto
            $this->authorize('update', $this->product);

            $this->product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ]);

            session()->flash('message', 'Produto atualizado com sucesso!');
        } else {
            // MODO CRIAÇÃO
            Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'user_id' => Auth::id(),
                'image' => 'https://placehold.co/600x400',
            ]);

            session()->flash('message', 'Produto criado com sucesso!');
        }

        return $this->redirectRoute('products.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
