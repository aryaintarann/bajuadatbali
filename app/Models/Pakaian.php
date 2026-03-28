<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model
{
    use HasFactory;
    protected $table = 'pakaian';
    protected $primaryKey = 'id_pakaian';
    protected $fillable = [
        'harga_pakaian',
        'stok_pakaian', // ✅ TAMBAH

        'nama_pakaian',
        'slug_pakaian',
        'gambar_pakaian',
        'pratinjau_pakaian',
        'kategori_pakaian_id',
        'butuh_ukuran', // Menandakan apakah produk butuh pemilihan ukuran
    ];


    // Relasi dengan KategoriPakaian
    public function kategoriPakaian()
    {
        return $this->belongsTo(KategoriPakaian::class, 'kategori_pakaian_id', 'id_kategori_pakaian');
    }



    public function orders()
    {
        return $this->hasMany(Order::class, 'pakaian_id', 'id_pakaian');
    }

    public function sizes()
    {
        return $this->hasMany(PakaianSize::class, 'pakaian_id', 'id_pakaian');
    }
}
