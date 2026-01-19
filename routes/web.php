<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importando seus componentes EXATOS (baseado nos arquivos que você enviou)
use App\Livewire\ProductList;
use App\Livewire\ProductForm;
use App\Livewire\CategoryList;
use App\Livewire\Dashboard;         
use App\Livewire\Auth\LoginRegister;

// Rota Inicial (Loja)
Route::get('/', ProductList::class)->name('home');

// Rota de Login (Usa seu LoginRegister.php)
Route::get('/login', LoginRegister::class)->name('login');

// Rota de Logout
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

// --- ÁREA RESTRITA ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // AQUI ESTAVA O ERRO: Agora aponta para a classe Dashboard que você JÁ TEM
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Produtos
    Route::get('/produtos', ProductList::class)->name('products.index');
    Route::get('/produtos/novo', ProductForm::class)->name('products.create');
    Route::get('/produtos/{product}/editar', ProductForm::class)->name('products.edit');

    // Categorias
    Route::get('/categorias', CategoryList::class)->name('categories.index');
});