<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $carts;
    public $user;
    public $total;

    /**
     * Create a new message instance.
     */
    public function __construct($carts, $user, $total)
    {
        $this->carts = $carts;
        $this->user = $user;
        $this->total = $total;
        // dd($user);
    }
    
    public function build()
    {
        return $this->subject('contoh subject')->view('emails.invoice');
    }
}
