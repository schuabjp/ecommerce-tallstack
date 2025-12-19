<?php

use App\Livewire\Auth\LoginRegister;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

//Rota Raiz/Pública
Route::get('/', Home::class)->name('home');

//Rota de Login
Route::get('/login', LoginRegister::class)->name('login')->middleware('guest');

//Requer Login
Route::middleware(['auth'])->group(function () {
    // Só é acessível se o usuário passar pelo middleware 'auth'
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});
