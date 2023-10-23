<?php

namespace App\Jobs;

use App\Interfaces\MessageUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationDoctor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $doctors;
    protected $time;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($doctors, $time, $message)
    {
        $this->doctors = $doctors;
        $this->time = $time;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(MessageUser $messageUser): void
    {
        $messageUser->sendManyDoctor($this->doctors , $this->message);
    }
}
