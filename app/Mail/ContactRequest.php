<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $request_info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_info)
    {
        $this->request_info = $request_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $mail = $this->from('notifications@printingamazon.com.au', config('app.name').' Notification')
                    ->subject('New Contact Request From Website')
                    ->view('emails.contact')
                    ->with([
                        'name'          => $this->request_info->get('name'),
                        'email'         => $this->request_info->get('email'),
                        'subject'       => $this->request_info->get('subject'),
                        'msg'           => $this->request_info->get('message'),
                        'ip'            => $this->request_info->get('ip'),
                    ]);

        if($this->request_info->has('attachment'))
        {
            $fileurl = $this->request_info->get('attachment');
            $mail->attach($fileurl);
        }

        return $mail;
    }
}
