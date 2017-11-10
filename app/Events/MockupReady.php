<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MockupReady
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $billing_name;
    public $billing_email;
    public $mockup;
    public $secure_url;
    public $order_token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($billing_name, $billing_email, $mockup, $order_token, $secure_url = '')
    {
        $this->billing_name = $billing_name;
        $this->billing_email = $billing_email;
        $this->mockup = asset('storage/'.$mockup);
        $this->order_token = $order_token;
        $this->secure_url = $secure_url;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
