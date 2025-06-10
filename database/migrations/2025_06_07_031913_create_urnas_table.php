<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('urna', function (Blueprint $table) {
            $table->id();
            $table->string('urna_nome');
            $table->string('urna_tipo');
            $table->string('urna_material');
            $table->decimal('urna_preco', 8, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urna');
    }
};
