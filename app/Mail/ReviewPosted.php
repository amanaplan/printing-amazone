<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewPosted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 120;
    public $content = [];
    public $common_conts = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reviewData, $common)
    {
        $this->content = $reviewData;
        $this->common_conts = $common;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notifications@atanudas.com', config('app.name').' Notification')
                    ->subject('Review awaiting for approval')
                    ->view('emails.reviewposted')
                    ->with([
                        'photo'         => $this->content['photo'],
                        'name'          => $this->content['name'],
                        'email'         => $this->content['email'],
                        'title'         => $this->content['title'],
                        'linktoadmin'   => $this->common_conts['linktoadmin'],
                        'logo_call'     => $this->common_conts['logo_call'],
                        'logo_main'     => $this->common_conts['logo_main'],
                        'website'       => $this->common_conts['website']
                    ]);
    }
}
