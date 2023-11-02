<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSendNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $userId;
    public $message;
    public $doctorId;
    public $messageDoctor;
    public $roleId;
    public $message_admin;
    public $appointmentId;



    public function __construct($userId='', $message='', $doctorId = '', $messageDoctor = '',$roleId='', $message_admin='',$appointmentId='')
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->doctorId = $doctorId;
        $this->messageDoctor = $messageDoctor;
        $this->roleId = $roleId;
        $this->message_admin = $message_admin;
        $this->$appointmentId = $appointmentId;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
