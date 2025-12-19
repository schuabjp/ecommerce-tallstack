<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Minha Área')]
class Dashboard extends Component
{
    // Replicando os produtos fictícios para visualização no Dashboard
    public $products = [
        ['id' => 1, 'name' => 'Notebook Gamer TALL', 'price' => 4500.00],
        ['id' => 2, 'name' => 'Smartphone Pro', 'price' => 2800.00],
        ['id' => 3, 'name' => 'Monitor UltraWide', 'price' => 1200.00],
    ];

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
