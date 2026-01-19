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

    // --- Campos do Produto ---
    public $name = '';

    public $description = '';

    public $price = '';

    #[Validate('nullable|image|max:1024|mimes:jpg,jpeg,png')]
    public $photo = null;

    // --- Campos da Categoria ---
    public $categories = []; // Lista para o <select>

    #[Validate('required|exists:categories,id')]
    public $category_id = ''; // O ID selecionado

    // --- Campos para NOVA Categoria (Modal) ---
    public $newCategoryName = '';

    public $newCategoryColor = '#3b82f6'; // Azul padrão

    public function mount(?Product $product = null)
    {
        // 1. Carrega todas as categorias para o select
        $this->categories = Category::all();

        // 2. Se for edição, preenche os campos
        if ($product && $product->exists) {
            $this->product = $product;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->category_id = $product->category_id; // Seleciona a categoria atual
        }
    }

    // Método exclusivo para criar categoria sem sair da tela
    public function createCategory()
    {
        // Segurança: Apenas Admin pode criar
        if (Auth::user()->role !== 'admin') {
            $this->addError('newCategoryName', 'Apenas admins podem criar categorias.');

            return;
        }

        $this->validate([
            'newCategoryName'  => 'required|string|min:3|max:255',
            'newCategoryColor' => 'required|string',
        ]);

        // Cria a categoria
        $category = Category::create([
            'name'    => $this->newCategoryName,
            'color'   => $this->newCategoryColor,
            'user_id' => Auth::id(),
        ]);

        // Atualiza a lista e seleciona a nova
        $this->categories = Category::all();
        $this->category_id = $category->id;

        // Reseta os campos da modal
        $this->reset(['newCategoryName', 'newCategoryColor']);

        // Avisa o front-end para fechar a modal
        $this->dispatch('category-created');

        session()->flash('message', 'Categoria criada!');
    }

    public function save()
    {
        $this->validate([
            'name'        => 'required|min:3',
            'description' => 'required',
            'price'       => 'required|numeric|min:1|max:999999',
            // category_id e photo já são validados pelos atributos
        ]);

        // Lógica da Imagem
        $imagePath = null;

        if ($this->photo) {
            $imagePath = '/storage/' . $this->photo->store('products', 'public');
        }

        // Dados base
        $data = [
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'category_id' => $this->category_id,
        ];

        if ($this->product && $this->product->exists) {
            // Edição
            if ($imagePath) {
                $data['image'] = $imagePath;
            }
            $this->product->update($data);
            session()->flash('message', 'Produto atualizado!');
        } else {
            // Criação
            $data['user_id'] = Auth::id();
            $data['image'] = $imagePath ?? 'https://placehold.co/600x400?text=Sem+Foto';
            Product::create($data);
            session()->flash('message', 'Produto criado!');
        }

        return $this->redirectRoute('products.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.product-form', [
            'title' => $this->product ? 'Editar Produto' : 'Novo Produto',
        ]);
    }
}
