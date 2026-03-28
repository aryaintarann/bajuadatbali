<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pakaian', function (Blueprint $table) {
            $table->integer('stok_pakaian')->default(0)->after('harga_pakaian');
        });
    }

    public function down()
    {
        Schema::table('pakaian', function (Blueprint $table) {
            $table->dropColumn('stok_pakaian');
        });
    }
};
