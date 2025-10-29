<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes to reports table
        if (!$this->hasIndex('reports', 'reports_status_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->index('status');
            });
        }
        if (!$this->hasIndex('reports', 'reports_created_at_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->index('created_at');
            });
        }
        if (!$this->hasIndex('reports', 'reports_user_id_status_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->index(['user_id', 'status']);
            });
        }
        if (!$this->hasIndex('reports', 'reports_category_id_status_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->index(['category_id', 'status']);
            });
        }

        // Add indexes to users table
        if (!$this->hasIndex('users', 'users_role_index')) {
            Schema::table('users', function (Blueprint $table) {
                $table->index('role');
            });
        }
        if (!$this->hasIndex('users', 'users_role_created_at_index')) {
            Schema::table('users', function (Blueprint $table) {
                $table->index(['role', 'created_at']);
            });
        }

        // Add unique constraint to categories table
        if (!$this->hasIndex('categories', 'categories_name_unique')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->unique('name');
            });
        }
    }

    /**
     * Check if an index exists on a table.
     */
    private function hasIndex(string $table, string $index): bool
    {
        $connection = Schema::getConnection();
        $databaseName = $connection->getDatabaseName();

        $result = DB::select(
            "SELECT COUNT(*) as count
             FROM information_schema.statistics
             WHERE table_schema = ?
             AND table_name = ?
             AND index_name = ?",
            [$databaseName, $table, $index]
        );

        return $result[0]->count > 0;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes from reports table
        if ($this->hasIndex('reports', 'reports_status_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->dropIndex(['status']);
            });
        }
        if ($this->hasIndex('reports', 'reports_created_at_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->dropIndex(['created_at']);
            });
        }
        if ($this->hasIndex('reports', 'reports_user_id_status_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->dropIndex(['user_id', 'status']);
            });
        }
        if ($this->hasIndex('reports', 'reports_category_id_status_index')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->dropIndex(['category_id', 'status']);
            });
        }

        // Drop indexes from users table
        if ($this->hasIndex('users', 'users_role_index')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex(['role']);
            });
        }
        if ($this->hasIndex('users', 'users_role_created_at_index')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex(['role', 'created_at']);
            });
        }

        // Drop unique constraint from categories table
        if ($this->hasIndex('categories', 'categories_name_unique')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropUnique(['name']);
            });
        }
    }
};

