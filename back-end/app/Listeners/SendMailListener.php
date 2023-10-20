<?php

namespace App\Listeners;

use App\Jobs\SendMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        SendMailJob::dispatch($event->data)->delay(now()->addSeconds(2));
    }
}
