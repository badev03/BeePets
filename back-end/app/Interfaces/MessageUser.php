<?php

namespace App\Interfaces;

interface MessageUser
{
    public function sendMessage($userId, $message);

    public function sendMessageDoctor($doctor_id , $message);
}
