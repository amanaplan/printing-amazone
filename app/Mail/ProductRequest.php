<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductRequest extends Mailable
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
        return $this->from('notifications@printingamazon.com.au', config('app.name').' Notification')
                    ->subject('New Product Order Request')
                    ->view('emails.order-label-graphics')
                    ->with([
                        'name'          => $this->request_info->get('name'),
                        'email'          => $this->request_info->get('email'),
                        'phone'          => $this->request_info->get('phone'),
                        'ip'          => $this->request_info->get('ip'),
                        'company'          => $this->request_info->get('company'),
                        'address'          => $this->request_info->get('address'),
                        'description'          => $this->request_info->get('description'),
                        'product'          => $this->request_info->get('product'),
                    ]);
    }
}
