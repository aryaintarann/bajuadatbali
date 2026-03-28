<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pakaian_sizes', function (Blueprint $table) {
            // Harga per ukuran — default 0 agar tidak breaking data lama
            $table->decimal('harga', 15, 2)->default(0)->after('stok');
        });
    }

    public function down(): void
    {
        Schema::table('pakaian_sizes', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }
};
