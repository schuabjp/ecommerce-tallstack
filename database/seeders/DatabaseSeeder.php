<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar o SUPER ADMIN
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@loja.com',
            'password' => Hash::make('password'),
            'role' => \App\Enums\UserRole::ADMIN,
            'document' => '00000000000',
        ]);

        // Criar produtos falsos
        \App\Models\Product::factory(50)->create();
    }
}
