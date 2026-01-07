<?php

declare(strict_types=1);

use App\Livewire\Auth\LoginRegister;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\ProductForm;
use App\Livewire\ProductList; // A Lista (Tabela)
use App\Models\Category;
use Illuminate\Support\Facades\Route; // O Formulário (Criar e Editar)

//Debug - Verificar categorias
Route::get('/debug-categories', function () {
    dd(Category::all());
});

//Vitrine
Route::get('/', Home::class)->name('home');

//Guest
Route::get('/login', LoginRegister::class)->name('login')->middleware('guest');

//(Auth)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    //Products - Read
    Route::get('/produtos', ProductList::class)->name('products.index');

    //Products - Create
    Route::get('/produtos/novo', ProductForm::class)->name('products.create');

    //Products - Update
    Route::get('/produtos/{product}/editar', ProductForm::class)->name('products.edit');

    //Category Management - Read
    Route::get('/categories', Category::class)->name('categories.index');

    //Category Management - Create
    Route::get('/categories/novo', Category::class)->name('categories.create');

    //Category Management - Update
    Route::get('/categories/{category}/editar', Category::class)->name('categories.edit');
});
