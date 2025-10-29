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
        Schema::table('reports', function (Blueprint $table) {
            $table->index('status');
            $table->index('created_at');
            $table->index(['user_id', 'status']);
            $table->index(['category_id', 'status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
            $table->index(['role', 'created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['category_id', 'status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['role', 'created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
    }
};

