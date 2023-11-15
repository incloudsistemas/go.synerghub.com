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
        Schema::create('insiders', function (Blueprint $table) {
            $table->id();
            // Contato
            $table->foreignId('contact_id')->unique();
            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Natureza Legal
            $table->foreignId('legal_nature_id')->nullable()->default(null);
            $table->foreign('legal_nature_id')
                ->references('id')
                ->on('legal_natures')
                ->onUpdate('cascade')
                ->onDelete('set null');
            // Categoria Econômica
            $table->foreignId('economic_category_id')->nullable()->default(null);
            $table->foreign('economic_category_id')
                ->references('id')
                ->on('economic_categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
            // Cnae
            $table->foreignId('cnae_id')->nullable()->default(null);
            $table->foreign('cnae_id')
                ->references('id')
                ->on('cnaes')
                ->onUpdate('cascade')
                ->onDelete('set null');
            // Nome
            $table->string('name');
            // Email
            $table->string('email')->unique();
            // Status
            // 0- Inativo, 1 - Ativo, 2 - Pendente.
            $table->char('status', 1)->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('insiders');
    }
};
