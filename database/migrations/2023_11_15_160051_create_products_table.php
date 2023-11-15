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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // 1 - Módulo Diagnose, 2 - Módulo Strategic.
            $table->char('module', 1);
            // Nome
            $table->string('name');
            // Abreviação
            // Od - Organizacional Diagnostics, Swot - SWOT Matrices, Pdca - PDCA Cicles, Bsc - Balanced Scorecard, Sp - Strategic Planning.
            $table->string('abbreviation')->nullable();
            // Descrição
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
