<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Início - E-commerce TALL')]
class Home extends Component
{
    public $products = [
        [
            'id' => 1,
            'name' => 'Notebook Gamer',
            'description' => 'Alta performance para Laravel e Livewire.',
            'price' => 4500.00,
            'image' => 'https://placehold.co/600x400/indigo/white?text=Notebook+TALL'
        ],
        [
            'id' => 2,
            'name' => 'Smartphone Pro',
            'description' => 'Conectividade total para assistir Laracast.',
            'price' => 2800.00,
            'image' => 'https://placehold.co/600x400/blue/white?text=Smartphone'
        ],
        [
            'id' => 3,
            'name' => 'Monitor UltraWide',
            'description' => 'Veja seu código com clareza.',
            'price' => 1200.00,
            'image' => 'https://placehold.co/600x400/purple/white?text=Monitor'
        ],
    ];

    public function render()
    {
        return view('livewire.home');
    }
}
