<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_tlpn',
        'email',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'subtotal',
        'ongkir',
        'total',
        'metode_pembayaran',
        'status',
        'order_id_midtrans',
        'shipping_status',
        'kurir',
        'nomor_resi',
        'refund_status',
        'refund_reason',
        'refund_requested_at',
        'refund_processed_at',
        'refund_bank_name',
        'refund_account_name',
        'refund_account_number',
        'refund_reject_reason',
    ];



    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
