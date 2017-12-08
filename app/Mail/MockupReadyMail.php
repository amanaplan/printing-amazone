<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MockupReadyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $url;
    public $order_token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $order_token, $url)
    {
        $this->name = $name;
        $this->order_token = $order_token;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Mock-Up is ready, Review & Approve')
                    ->view('emails.mockup-ready');
    }
}
