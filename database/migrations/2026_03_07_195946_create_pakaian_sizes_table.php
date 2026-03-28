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
        Schema::create('pakaian_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pakaian_id');
            $table->string('ukuran', 10);
            $table->integer('stok')->default(0);
            $table->timestamps();

            $table->foreign('pakaian_id')->references('id_pakaian')->on('pakaian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakaian_sizes');
    }
};
