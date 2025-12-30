<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\LoginRegister;
use App\Livewire\Dashboard;
use App\Livewire\ProductList; // A Lista (Tabela)
use App\Livewire\ProductForm; // O Formulário (Criar e Editar)

//Vitrine
Route::get('/', Home::class)->name('home');


//Guest
Route::get('/login', LoginRegister::class)->name('login')->middleware('guest');


//(Auth)
Route::middleware(['auth'])->group(function () {

    // Painel
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    //Read
    Route::get('/produtos', ProductList::class)->name('products.index');

    //Create
    Route::get('/produtos/novo', ProductForm::class)->name('products.create');

    //Update
    Route::get('/produtos/{product}/editar', ProductForm::class)->name('products.edit');
});
