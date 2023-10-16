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
            ->get();
        if ($notifications) {
            return response()->json(['notifications' => $notifications] , 200);
        }
        else {
            return response()->json(['msg' => 'Không có dữ liệu'] , 400);
        }
    }
}
