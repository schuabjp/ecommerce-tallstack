<?php

use App\Livewire\Auth\LoginRegister;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\ProductList; // <--- IMPORTANTE: Importar o componente
use Illuminate\Support\Facades\Route;

//Rota Raiz/Pública
Route::get('/', Home::class)->name('home');

// Rotas de Autenticação (Login e Registro)
Route::get('/login', LoginRegister::class)->name('login')->middleware('guest');

Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/produtos', ProductList::class)->name('products.index'); 
});