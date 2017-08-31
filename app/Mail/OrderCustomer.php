<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCustomer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 20;
    public $timeout = 120;

    public $common_conts;
    public $order_info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($common, $order_info)
    {
        $this->common_conts = $common;

        $this->order_info = $order_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orders@printingamazon.com.au', config('app.name').' Order')
                    ->subject('Order placed successfully - '.$this->order_info->get('order_id'))
                    ->view('emails.order-customer')
                    ->with([
                        'logo'          => $this->common_conts->get('logo'),
                        'order_id'      => $this->order_info->get('order_id'),
                        'trans_id'      => $this->order_info->get('transaction_id'),
                        'country'       => $this->order_info->get('country'),
                        'state'         => json_decode($this->order_info->get('state')),
                        'city'          => json_decode($this->order_info->get('city')),
                        'zipcode'       => json_decode($this->order_info->get('zipcode')),
                        'street'        => json_decode($this->order_info->get('street')),
                        'subtotal'      => $this->order_info->get('subtotal'),
                        'discount'      => $this->order_info->get('discount'),
                        'payable'       => $this->order_info->get('payable'),
                        'items'         => json_decode($this->order_info->get('items')),
                        'delivery_img'  => $this->common_conts->get('delivery_img'),
                        'prod_logo_dir' => $this->common_conts->get('prod_logo_dir'),
                        'website'       => $this->common_conts->get('website')
                    ]);
    }
}
