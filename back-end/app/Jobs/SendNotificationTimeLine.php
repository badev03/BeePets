<?php

namespace App\Jobs;

use App\Interfaces\MessageUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationTimeLine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $users;
    protected $time;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($users, $time, $message)
    {
        $this->users = $users;
        $this->time = $time;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(MessageUser $messageUser): void
    {
        $messageUser->sendManyUser($this->users , $this->message);
    }
}
