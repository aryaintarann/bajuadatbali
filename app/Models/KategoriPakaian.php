<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPakaian extends Model
{
    use HasFactory;
    protected $table = 'kategori_pakaians';
    protected $primaryKey = 'id_kategori_pakaian';
    protected $fillable = [
        'nama_kategori_pakaian',

    ];
}
