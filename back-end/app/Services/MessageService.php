<?php
namespace App\Services;

use App\Interfaces\MessageUser;
use App\Models\Notification;
use App\Traits\QueryCommon;
use Pusher\Pusher;

class MessageService implements MessageUser {

    use QueryCommon;
    public function sendMessage($userId ='', $message='' , $doctor_id='' , $message_doctor = '')
    {
        $dataMessage = $this->tableQuery('users')->where('id' , $userId)->first();
        $messagess = [
            'name' => $dataMessage->name,
            'avatar' => $dataMessage->avatar,
            'id' => $dataMessage->id,
            'message' => $message,
        ];
        $dataMessageDoctor = $this->tableQuery('doctors')->where('id' , $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor
        ];
        $this->pusherWeb()->trigger("user-notification-".$userId, 'notification-event-test', $messagess );
        $this->pusherWeb()->trigger("doctor-notification-".$doctor_id, 'notification-event-doctor', $message_doctors);
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor,
            'read_user' => 0,
            'read_doctor' => 0,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendManyUser($userId ='', $message='') {

        $dataMessage = $this->tableQuery('users')->where('id' , $userId)->first();
        $messagess = [
            'name' => $dataMessage->name,
            'avatar' => $dataMessage->avatar,
            'id' => $dataMessage->id,
            'message' => $message
        ];

        $this->pusherWeb()->trigger("user-notification-".$userId, 'notification-event-test', $messagess );
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendManyDoctor($doctor_id, $message_doctor)
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);
        $dataMessageDoctor = $this->tableQuery('doctors')->where('id' , $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor
        ];
        $pusher->trigger("doctor-notification-".$doctor_id, 'notification-event-doctor', $message_doctors );
        Notification::create([
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }
    public function sendDoctorToAdmin($doctor_id, $message_doctor, $roleId, $message_admin,$appointmentId)
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $dataMessageDoctor = $this->tableQuery('doctors')->where('id', $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor
        ];

        $users = $this->tableQuery('users')->where('role_id', $roleId)->get();

        foreach ($users as $user) {
            $messagess = [
                'name' => $user->name,
                'avatar' => $user->avatar,
                'role_id' => $user->role_id,
                'message_admin' => $message_admin,
                'appointment_id' => $appointmentId
            ];
            $pusher->trigger("user-notification-" . $user->id, 'notification-event-test', $messagess);
            Notification::create([
                'user_id' => $user->id,
                'message_admin' => $message_admin,
                'message' => '',
                'doctor_id' => $doctor_id,
                'message_doctor' => $message_doctor,
                'appointment_id' => $appointmentId
            ]);
        }

        $pusher->trigger("doctor-notification-" . $doctor_id, 'notification-event-doctor', $message_doctors);

        return response()->json(['message' => 'Thông báo đã được gửi đến tất cả người dùng có role_id là ' . $roleId]);
    }


        public function pusherWeb()
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);
        return $pusher;
    }


    public function sendMessageNew($userId ='', $message='' , $doctor_id='' , $message_doctor = '' , $appointment_id='')
    {
        $dataMessage = $this->tableQuery('users')->where('id' , $userId)->first();
        $messagess = [
            'name' => $dataMessage->name,
            'avatar' => $dataMessage->avatar,
            'id' => $dataMessage->id,
            'message' => $message,
            'appointment_id' => $appointment_id,
        ];
        $dataMessageDoctor = $this->tableQuery('doctors')->where('id' , $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor,
            'appointment_id' => $appointment_id,
        ];
        $this->pusherWeb()->trigger("user-notification-".$userId, 'notification-event-test', $messagess );
        $this->pusherWeb()->trigger("doctor-notification-".$doctor_id, 'notification-event-doctor', $message_doctors);
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor,
            'read_user' => 0,
            'read_doctor' => 0,
            'appointment_id' => $appointment_id,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendAdmin($appointment_id='' , $message_admin = '' , $message= '' , $userId='')
    {
        $this->pusherWeb()->trigger("admin-notification", 'notification-event-admin', $message_admin);
        Notification::create([
            'appointment_id' => $appointment_id,
            'message_admin' => $message_admin,
            'message' => $message,
            'read' => 0,
            'admin_id' => 1,
            'user_id' => $userId,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }
}
