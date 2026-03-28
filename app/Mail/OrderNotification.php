<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderNotification extends Mailable
{
    public $order;
    public $estimasi;
    public $tipe;

    public function __construct($order, $estimasi, $tipe)
    {
        $this->order = $order;
        $this->estimasi = $estimasi;
        $this->tipe = $tipe;
    }

    public function build()
    {
        return $this->subject(
            $this->tipe === 'owner'
                ? 'Pesanan Baru Masuk'
                : 'Pesanan Anda Berhasil'
        )
            ->view(
                $this->tipe === 'owner'
                    ? 'emails.order_notification'
                    : 'emails.order-customer'
            );
    }
}
