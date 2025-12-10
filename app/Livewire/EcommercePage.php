<?php

namespace App\Livewire;

use Livewire\Component;

class EcommercePage extends Component
{
    // Propriedades públicas - são reativas
    public $mobileMenuOpen = false;
    public $cart = [];
    public $email = '';

    // Produtos em destaque (em produção viriam do banco)
    public $featuredProducts = [
        [
            'id' => 1,
            'name' => 'Notebook Premium',
            'price' => 3499.90,
            'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop',
            'category' => 'Eletrônicos',
            'rating' => 4.8
        ],
        [
            'id' => 2,
            'name' => 'Smartphone Pro',
            'price' => 2199.90,
            'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop',
            'category' => 'Eletrônicos',
            'rating' => 4.9
        ],
        [
            'id' => 3,
            'name' => 'Fone Bluetooth',
            'price' => 299.90,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop',
            'category' => 'Áudio',
            'rating' => 4.7
        ]
    ];

    // Método para alternar menu mobile
    public function toggleMobileMenu()
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }

    // Método para adicionar produto ao carrinho
    public function addToCart($productId)
    {
        // Encontra o produto
        $product = collect($this->featuredProducts)->firstWhere('id', $productId);

        if ($product) {
            // Adiciona ao carrinho
            $this->cart[] = $product;

            // Dispara notificação (usando Alpine.js na view)
            $this->dispatch('product-added', name: $product['name']);
        }
    }

    // Método para cadastrar e-mail
    public function subscribe()
    {
        // Validação
        $this->validate([
            'email' => 'required|email'
        ]);

        // Usado para salvar no banco
        // Newsletter::create(['email' => $this->email]);

        session()->flash('message', 'E-mail cadastrado com sucesso!');
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.ecommerce-page');
    }
}
