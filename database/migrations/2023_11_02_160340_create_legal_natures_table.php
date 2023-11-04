<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('legal_natures', function (Blueprint $table) {
            $table->id();
            // Código
            $table->string('code');
            // Grupo
            // 1 - Administração Pública, 2 - Entidades Empresariais, 3 - Entidades Sem Fins Lucrativos, 4 - Pessoas Físicas, 5 - Instituições Extra Territoriais
            $table->integer('role')->nullable();
            // Nome
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_natures');
    }
};
