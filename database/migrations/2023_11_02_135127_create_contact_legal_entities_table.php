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
        Schema::create('contact_legal_entities', function (Blueprint $table) {
            $table->id();
            // Nome
            $table->string('name');
            // $table->string('slug')->unique();
            // Email
            $table->string('email')->unique()->nullable();
            // Nome fantasia
            $table->string('trade_name')->nullable();
            // CNPJ
            $table->string('cnpj')->nullable();
            // Inscrição municipal
            $table->string('municipal_registration')->nullable();
            // Inscrição estadual
            $table->string('state_registration')->nullable();
            // NIRE (Número de Identificação do Registro de Empresas)
            $table->string('nire')->nullable();
            // Dt. registro NIRE
            $table->date('nire_registered_at')->nullable();
            // Capital social
            $table->integer('share_capital')->nullable();
            // Regime de tributação
            $table->char('tax_regime', 1)->nullable();
            // Apuração dos tributos
            $table->char('tax_assessment', 1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_legal_entities');
    }
};
