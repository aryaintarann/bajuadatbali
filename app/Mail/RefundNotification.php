<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RefundNotification extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Pengajuan Refund Baru')
            ->view('emails.refund_admin');
    }
}
