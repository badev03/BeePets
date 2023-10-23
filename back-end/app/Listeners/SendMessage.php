<?php

namespace App\Listeners;

use App\Events\MessageSendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessage implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function __constructor()
    {
        //
    }

    public function handle(MessageSendNotification $event)
    {
        $messageService = new \App\Services\MessageService();
        $messageService->sendManyUser($event->userId, $event->message, $event->doctorId, $event->messageDoctor);
    }
}
