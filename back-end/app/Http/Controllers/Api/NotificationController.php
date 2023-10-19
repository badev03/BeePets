<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotification()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->select('notifications.user_id as id' , 'users.avatar' , 'users.name' , 'notifications.message')
            ->join('users' , 'users.id' , '=' , 'notifications.user_id')
            ->where('notifications.message' , '!=' , '')
            ->orderBy('notifications.id', 'DESC')
            ->get();
        if ($notifications) {
            return response()->json(['notifications' => $notifications] , 200);
        }
        else {
            return response()->json(['msg' => 'Không có dữ liệu'] , 400);
        }
    }

    public function getNotificationDoctor()
    {
        $notifications = Notification::where('doctor_id', auth()->guard('doctors')->id())
            ->select('notifications.doctor_id as id' , 'doctors.image as avatar' , 'doctors.name' , 'notifications.message_doctor as message')
            ->join('doctors' , 'doctors.id' , '=' , 'notifications.doctor_id')
            ->where('notifications.message_doctor' , '!=' , '')
            ->orderBy('notifications.id', 'DESC')
            ->get();
        if ($notifications) {
            return response()->json(['notifications' => $notifications] , 200);
        }
        else {
            return response()->json(['msg' => 'Không có dữ liệu'] , 400);
        }
    }


}
