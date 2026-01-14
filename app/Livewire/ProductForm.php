<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public ?Product $product = null;

    public $name = '';

    public $description = '';

    public $price = '';

    public $categories = [];

    public $category_name = '';

    public $category_id = '';

    #[Validate('nullable|image|max:1024|mimes:jpg,jpeg,png')]
    public $photo = null;

    public function mount(?Product $product = null)
    {
        $this->categories = Category::all();

        if ($product && $product->exists) {
            $this->product = $product;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->category_id = $product->category_id;
        }
    }

    public function save()
    {
        $this->validate([
            'name'        => 'required|min:3',
            'description' => 'required',
            'price'       => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = null;

        if ($this->photo) {
            $imagePath = $this->photo->store('products', 'public');
            $imagePath = '/storage/' . $imagePath;
        }

        if ($this->product && $this->product->exists) {
            // --- MODO EDIÇÃO ---
            $data = [
                'name'        => $this->name,
                'description' => $this->description,
                'price'       => $this->price,
            ];

            // Só atualiza a imagem se o usuário tiver enviado uma nova
            if ($imagePath) {
                $data['image'] = $imagePath;
            }

            $this->product->update([
                'name'        => $this->name,
                'description' => $this->description,
                'price'       => $this->price,
                'image'       => $imagePath ?? $this->product->image,
                'category_id' => $this->category_id, // <--- Salvar Categoria
            ]);

            session()->flash('message', 'Produto atualizado!');
        } else {
            Product::create([
                'name'        => $this->name,
                'description' => $this->description,
                'price'       => $this->price,
                'image'       => $imagePath ?? '...',
                'user_id'     => Auth::id(),
                'category_id' => $this->category_id, // <--- Salvar Categoria
            ]);

            session()->flash('message', 'Produto criado!');
        }
    }

    public function render()
    {
        // Define o título dinamicamente
        $pageTitle = $this->product ? 'Editar Produto' : 'Novo Produto';

        return view('livewire.product-form', [
            'title' => $pageTitle,
        ]);
    }
}
