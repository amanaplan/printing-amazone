<?php

namespace App\Listeners;

use App\Events\MockupReady;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MockupReadyMail;

class ApproveMockupNotify implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'default';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MockupReady  $event
     * @return void
     */
    public function handle(MockupReady $event)
    {
        //Log::info($event->user_email);
        Mail::to($event->billing_email)->send(new MockupReadyMail($event->billing_name, $event->order_token, $event->secure_url));

    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\MockupReady  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(MockupReady $event, $exception)
    {
        //
    }
}
