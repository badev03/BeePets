<?php

namespace App\Interfaces;

interface MessageUser
{
    public function sendMessage($userId, $message , $doctor_id , $message_doctor);

}
