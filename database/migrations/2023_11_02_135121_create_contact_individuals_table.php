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
        Schema::create('contact_individuals', function (Blueprint $table) {
            $table->id();
            // Nome
            $table->string('name');
            // $table->string('slug')->unique();
            // Email
            $table->string('email')->unique()->nullable();
            // CPF
            $table->string('cpf')->nullable();
            // RG/ Órgão Expedidor
            $table->string('rg')->nullable();
            // Sexo
            // M - 'Masculino', F - 'Feminino'.
            $table->char('gender', 1)->nullable();
            // Data de nascimento
            $table->date('birth_date')->nullable();
            // Estado civil
            // 1 - 'Solteiro(a)', 2 - 'Casado(a)', 3 - 'Divorciado(a)', 4 - 'Viúvo(a)', 5 - 'Separado(a)', 6 - 'Companheiro(a)'.
            $table->integer('marital_status')->nullable();
            // Escolaridade
            //1 - 'Fundamental', 2 - 'Médio', 3 - 'Superior', 4 - 'Pós-graduação', 5 - 'Mestrado', 6 - 'Doutorado'.
            $table->integer('educational_level')->nullable();
            // Nacionalidade
            $table->string('nationality')->nullable();
            // Cidadania / Naturalidade
            $table->string('citizenship')->nullable();
            // Cargo
            $table->string('occupation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_individuals');
    }
};
