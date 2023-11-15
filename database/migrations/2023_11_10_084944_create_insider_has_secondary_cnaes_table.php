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
        Schema::create('insider_has_secondary_cnaes', function (Blueprint $table) {
            // Insider
            $table->foreignId('insider_id');
            $table->foreign('insider_id')
                ->references('id')
                ->on('insiders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Cnae
            $table->foreignId('cnae_id');
            $table->foreign('cnae_id')
                ->references('id')
                ->on('cnaes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Não permite o insider ter cnaes duplicados.
            $table->unique(['insider_id', 'cnae_id'], 'insider_cnae_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('insider_has_cnaes');
    }
};
