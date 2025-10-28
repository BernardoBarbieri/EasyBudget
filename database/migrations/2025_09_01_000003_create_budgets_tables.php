<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela budgets (itens de orçamento por evento)
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('description'); // 🧾 Descrição do item do orçamento
            $table->decimal('price', 10, 2); // 💰 Preço unitário
            $table->integer('quantity'); // 🔢 Quantidade
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela budgets caso seja revertido
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
