<?php

namespace App\Interfaces;

interface MessageUser
{
    public function sendMessage($userId, $message , $doctor_id , $message_doctor);
    public function sendManyUser($userId , $message);
    public function sendManyDoctor($doctor_id , $message_doctor);
}
