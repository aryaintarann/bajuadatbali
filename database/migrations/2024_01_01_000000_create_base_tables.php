<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('last_page')->nullable();
            $table->json('devices')->nullable();
            $table->timestamps();
        });

        // Kategori Produk
        Schema::create('kategori_pakaians', function (Blueprint $table) {
            $table->id('id_kategori_pakaian');
            $table->string('nama_kategori_pakaian');
            $table->timestamps();
        });

        // Pakaian
        Schema::create('pakaian', function (Blueprint $table) {
            $table->id('id_pakaian');
            $table->string('nama_pakaian');
            $table->string('slug_pakaian')->unique();
            $table->integer('harga_pakaian');
            $table->integer('ongkir')->default(0); // For remove_ongkir migration compatibility
            $table->string('gambar_pakaian')->nullable(); // stored path
            $table->text('pratinjau_pakaian')->nullable();
            $table->unsignedBigInteger('kategori_pakaian_id')->nullable();
            $table->timestamps();

            $table->foreign('kategori_pakaian_id')->references('id_kategori_pakaian')->on('kategori_pakaians')->onDelete('set null');
        });

        // Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('no_tlpn');
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ongkir', 15, 2)->default(0);
            $table->decimal('total', 15, 2);
            $table->string('metode_pembayaran');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        // Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('nama_pakaian');
            $table->decimal('harga_pakaian', 15, 2);
            $table->integer('quantity');
            $table->timestamps();
        });

        // Setting
        Schema::create('setting', function (Blueprint $table) {
            $table->id('id_setting');
            $table->string('instansi_setting')->nullable();
            $table->string('pimpinan_setting')->nullable();
            $table->string('logo_setting')->nullable();
            $table->string('favicon_setting')->nullable();
            $table->text('tentang_setting')->nullable();
            $table->text('misi_setting')->nullable();
            $table->text('visi_setting')->nullable();
            $table->text('keyword_setting')->nullable();
            $table->text('alamat_setting')->nullable();
            $table->string('instagram_setting')->nullable();
            $table->string('youtube_setting')->nullable();
            $table->string('email_setting')->nullable();
            $table->string('no_hp_setting')->nullable();
            $table->text('maps_setting')->nullable();
            $table->timestamps();
        });

        // Berita
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul_berita');
            $table->string('slug_berita')->unique();
            $table->text('isi_berita');
            $table->string('gambar_berita')->nullable();
            $table->date('tanggal_berita')->nullable();
            $table->timestamps();
        });

        // Layanan
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->string('nama_layanan');
            $table->string('slug_layanan')->unique();
            $table->string('gambar_layanan')->nullable();
            $table->text('keterangan_layanan')->nullable();
            $table->timestamps();
        });

        // Galeri
        Schema::create('galeri', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->string('nama_galeri');
            $table->string('jenis_galeri')->nullable(); // e.g. 'foto', 'video'
            $table->text('keterangan_galeri')->nullable();
            $table->string('gambar_galeri')->nullable();
            $table->timestamps();
        });

        // Sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Failed Jobs
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Password Resets
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('setting');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('pakaian');
        Schema::dropIfExists('kategori_pakaians');
        Schema::dropIfExists('users');
    }
};
