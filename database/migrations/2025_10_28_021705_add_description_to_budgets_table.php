<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a migration (adiciona a coluna).
     */
    public function up(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            // Adiciona a coluna 'description' após o event_id, se ainda não existir
            if (!Schema::hasColumn('budgets', 'description')) {
                $table->string('description')->after('event_id');
            }
        });
    }

    /**
     * Reverte a migration (remove a coluna).
     */
    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            if (Schema::hasColumn('budgets', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
