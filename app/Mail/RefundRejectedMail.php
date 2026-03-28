<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RefundRejectedMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Refund Ditolak')
            ->view('emails.refund_rejected');
    }
}
