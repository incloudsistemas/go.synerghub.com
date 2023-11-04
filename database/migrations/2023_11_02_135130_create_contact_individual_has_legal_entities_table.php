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
        Schema::create('contact_individual_has_legal_entities', function (Blueprint $table) {
            // P. Física
            $table->foreignId('individual_id');
            $table->foreign('individual_id', 'individual_foreign')
                ->references('id')
                ->on('contact_individuals')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // P. Jurídica
            $table->foreignId('legal_entity_id');
            $table->foreign('legal_entity_id', 'legal_entity_foreign')
                ->references('id')
                ->on('contact_legal_entities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Principal? order 0 - main
            $table->integer('order')->default(1);
            // Não permite o contato ter empresas duplicadas.
            $table->unique(['individual_id', 'legal_entity_id'], 'individual_has_legal_entities_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('contact_individual_has_legal_entities');
    }
};
