<?php

namespace App\Interfaces;

interface MessageUser
{
    public function sendMessage($userId, $message);
}
