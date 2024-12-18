<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $order;
    public $trackingNumber; // Pastikan ini didefinisikan

    public function __construct($order, $trackingNumber)
    {
        $this->order = $order;
        $this->trackingNumber = $trackingNumber; // Pastikan ini diinisialisasi
    }

    public function build()
    {
        return $this->subject('Order Confirmation')
                    ->view('emails.order_confirmation')
                    ->with([
                        'trackingNumber' => $this->trackingNumber, // Pastikan ini sesuai
                    ]);
    }

    /**
     * Get the message envelope.
     */

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
