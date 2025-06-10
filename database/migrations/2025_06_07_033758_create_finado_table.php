<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finados', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('finado_nome');
            $table->string('finado_certidao');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finados');
    }
};
