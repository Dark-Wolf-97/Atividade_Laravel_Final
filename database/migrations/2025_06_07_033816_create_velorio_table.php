<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('velorios', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->date('velorio_data');

            // Chaves estrangeiras
            $table->foreignId('finado_id')->constrained('finados')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('urna_id')->constrained('urna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('velorios');
    }
};
