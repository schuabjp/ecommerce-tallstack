<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            // Relacionamento com o usuário (Se apagar o usuário, apaga os endereços)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name')->nullable(); // Ex: "Casa", "Trabalho"
            $table->string('cep');
            $table->string('street');      // Logradouro
            $table->string('number');      // Número
            $table->string('complement')->nullable();
            $table->string('neighborhood'); // Bairro
            $table->string('city');        // Localidade
            $table->string('state');       // UF

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
