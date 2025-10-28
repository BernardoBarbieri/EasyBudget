<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            // Se existir, remove a coluna 'item'
            if (Schema::hasColumn('budgets', 'item')) {
                $table->dropColumn('item');
            }
        });
    }

    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            // Caso precise reverter, recria a coluna
            if (!Schema::hasColumn('budgets', 'item')) {
                $table->string('item')->nullable();
            }
        });
    }
};
