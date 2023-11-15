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
        Schema::create('insider_has_performance_areas', function (Blueprint $table) {
            // Insider
            $table->foreignId('insider_id');
            $table->foreign('insider_id')
                ->references('id')
                ->on('insiders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Área de Atuação
            $table->foreignId('performance_area_id');
            $table->foreign('performance_area_id')
                ->references('id')
                ->on('performance_areas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Não permite o insider ter áreas de atuações duplicados.
            $table->unique(['insider_id', 'performance_area_id'], 'insider_performance_area_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('insider_has_performance_areas');
    }
};
