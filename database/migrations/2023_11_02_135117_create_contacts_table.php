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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // contactable_id e contactable_type
            $table->morphs('contactable');
            // Email(s) adicionais
            $table->json('additional_emails')->nullable();
            // Telefone(s) de contato
            $table->json('phones')->nullable();
            // Atributos personalizados
            $table->json('custom')->nullable();
            // Permite apenas um contato por registro.
            $table->unique(['contactable_id', 'contactable_type'], 'contactable_unique');
            // Complemento
            $table->text('complement')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
