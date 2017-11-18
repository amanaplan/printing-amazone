<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminMockupReview extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $is_approved;
    public $user_msg;
    public $order_token;
    public $order_id;
    public $item_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($is_approved, $user_msg, $order_token, $order_id, $item_id)
    {
        $this->is_approved  = $is_approved;
        $this->user_msg     = $user_msg;
        $this->order_token  = $order_token;
        $this->order_id     = $order_id;
        $this->item_id      = $item_id;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = ($this->is_approved)? 'User Has Approved The Mockup' : 'User Has Requested For Further Change in Mockup';
        $mail_conts = ($this->is_approved) ? 'User has just approved the mockup' : 'User has requested for further adjustment in the mockup';

        return $this->subject($subject)
            ->view('emails.admin-mockup-approval')
            ->with([
                'mail_conts'    => $mail_conts,
                'backend_order_page'    =>  url('/admin/order-details/'. $this->order_id .'/'. $this->item_id),
            ]);
    }
}
