<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakaianSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'pakaian_id',
        'ukuran',
        'stok',
        'harga',
    ];

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class, 'pakaian_id', 'id_pakaian');
    }
}
