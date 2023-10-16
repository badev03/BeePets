<?php

namespace App\Jobs;

use App\Mail\SendEmailAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailAppointmentQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $send_mail_appointment;
    public function __construct($send_mail_appointment)
    {
        $this->send_mail_appointment = $send_mail_appointment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailAppointment();
        Mail::to($this->send_mail_appointment)->send($email);
    }
}
