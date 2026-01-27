<?php

declare(strict_types=1);

use App\Livewire\Admin\PromotionManager;
use App\Livewire\Auth\LoginRegister;
use App\Livewire\CategoryList;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\ProductForm;
use App\Livewire\ProductList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 1. Home Page (Vitrine de Promoções)
Route::get('/', Home::class)->name('home');

// 2. Login e Logout
Route::get('/login', LoginRegister::class)->name('login');
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/');
})->name('logout');

// 3. Área Logada
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/produtos', ProductList::class)->name('products.index');
    Route::get('/produtos/novo', ProductForm::class)->name('products.create');
    Route::get('/produtos/{product}/editar', ProductForm::class)->name('products.edit');
    Route::get('/categorias', CategoryList::class)->name('categories.index');
    Route::get('/meus-enderecos', App\Livewire\AddressManager::class)->name('addresses.index');

    // 4. Rota do Admin (Promoções)
    Route::get('/admin/promocoes', PromotionManager::class)->name('admin.promotions');
});
