<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Lista de hardwares para parecer real
        $hardware = [
            'Placa de Vídeo RTX 4090', 'Processador Intel i9', 'SSD NVMe 1TB', 
            'Memória RAM 32GB DDR5', 'Fonte 850W Gold', 'Gabinete Gamer', 
            'Monitor 144hz', 'Teclado Mecânico', 'Mouse Gamer', 'Placa Mãe Z790'
        ];

        return [
            // Escolhe um nome aleatório e adiciona números para variar
            'name' => fake()->randomElement($hardware) . ' ' . fake()->bothify('##??'),
            
            'description' => fake()->paragraph(2),
            
            // Preço entre R$ 100 e R$ 15.000
            'price' => fake()->randomFloat(2, 100, 15000),
            
            // Imagem genérica (placeholder)
            'image' => 'https://placehold.co/600x400/333/FFF?text=Hardware',
            
            // Pega o ID do primeiro usuário (Admin) ou cria um novo se não existir
            'user_id' => User::first()->id ?? User::factory(),
        ];
    }
}