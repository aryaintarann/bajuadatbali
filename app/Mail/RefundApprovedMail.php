<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RefundApprovedMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Refund Disetujui')
            ->view('emails.refund_approved');
    }
}
