<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Laravel 10+ uses "password_reset_tokens" instead of "password_resets".
     * If the old table exists, rename it. Otherwise create fresh.
     */
    public function up(): void
    {
        if (Schema::hasTable('password_resets') && !Schema::hasTable('password_reset_tokens')) {
            // Rename the old table to the new name
            DB::statement('RENAME TABLE `password_resets` TO `password_reset_tokens`');

            // Add primary key if the old table only had an index on email
            Schema::table('password_reset_tokens', function (Blueprint $table) {
                // Add columns if missing
                if (!Schema::hasColumn('password_reset_tokens', 'token')) {
                    $table->string('token');
                }
                if (!Schema::hasColumn('password_reset_tokens', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
            });

        } elseif (!Schema::hasTable('password_reset_tokens')) {
            // Create fresh
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
        // If both exist or password_reset_tokens already exists, do nothing
    }

    public function down(): void
    {
        if (Schema::hasTable('password_reset_tokens') && !Schema::hasTable('password_resets')) {
            DB::statement('RENAME TABLE `password_reset_tokens` TO `password_resets`');
        } else {
            Schema::dropIfExists('password_reset_tokens');
        }
    }
};
