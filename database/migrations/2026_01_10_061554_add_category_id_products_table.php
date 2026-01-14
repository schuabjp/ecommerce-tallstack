<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Adiciona a coluna category_id com a restrição de foreign key
            $table->foreignId('category_id')
                ->nullable() // Permite que produtos não tenham categoria
                ->constrained()
                ->nullOnDelete(); // Se a categoria for deletada, seta como null
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Se desfizer a migration, a chave e a coluna são removidas.
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
