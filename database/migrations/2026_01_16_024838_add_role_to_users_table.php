<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Cria a coluna (Run the migrations)
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // default('user') garante que ninguém vire admin sozinho.
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Remove a coluna se der erro (Reverse the migrations)
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
