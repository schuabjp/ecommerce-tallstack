<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product; // <--- Importante
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole; // <--- Importante

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cria o SEU usuário Admin (para você conseguir logar)
        User::create([
            'name' => 'Admin Supremo',
            'email' => 'admin@loja.com',
            'password' => Hash::make('password'), // Senha: password
            'document' => '00000000000',
            'role' => UserRole::ADMIN,
        ]);

        // 2. Cria 10 usuários normais
        User::factory(10)->create();

        // 3. Cria 50 Produtos
        // A Factory do produto já vincula a um usuário existente aleatório ou cria um novo
        Product::factory(50)->create();
    }
}