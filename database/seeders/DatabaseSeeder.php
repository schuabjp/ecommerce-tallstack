<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <--- Importe a classe de Strings (Texto)
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tenta pegar a senha do arquivo .env
        // 2. Se NÃO tiver nada no .env, gera uma senha aleatória de 32 letras.
        $senhaAdmin = env('ADMIN_DEFAULT_PASSWORD', Str::random(32));

        User::create([
            'name'     => 'Admin Supremo',
            'email'    => 'admin@loja.com',
            'password' => Hash::make($senhaAdmin),
            'document' => '00000000000',
            'role'     => UserRole::ADMIN,
        ]);

        // Mostra no terminal qual senha foi usada
        $this->command->info('Admin criado!');
        $this->command->info('Email: admin@loja.com');

        $this->command->info('Senha usada: ' . (env('ADMIN_DEFAULT_PASSWORD') ? env('ADMIN_DEFAULT_PASSWORD') : 'Gerada Aleatoriamente (Verifique os logs ou resete)'));

        User::factory(10)->create();
        Product::factory(50)->create();
    }
}
