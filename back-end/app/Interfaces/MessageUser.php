<?php

namespace App\Interfaces;

interface MessageUser
{
    public function sendMessage($userId, $message , $doctor_id , $message_doctor, $appointment_id);
    public function sendMessageNew($userId, $message , $doctor_id , $message_doctor , $appointment_id);
    public function sendManyUser($userId , $message);
    public function sendManyDoctor($doctor_id , $message_doctor);

    // gửi thông báo từ doctor đến admin có role_id = 1

    public function sendDoctorToAdmin($doctor_id,$message_doctor,$roleId,$message_admin,$appointmentId);


}
