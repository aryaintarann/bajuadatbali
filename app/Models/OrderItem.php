<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'nama_pakaian',
        'harga_pakaian',
        'quantity',
        'pakaian_id',
        'ukuran',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }
}
