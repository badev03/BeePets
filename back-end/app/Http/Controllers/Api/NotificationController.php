<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotification()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->select('notifications.user_id as id' , 'users.avatar' , 'users.name' , 'notifications.message'
                , 'notifications.id as id_notification' , 'notifications.appointment_id')
            ->join('users' , 'users.id' , '=' , 'notifications.user_id')
            ->where('notifications.message' , '!=' , '')
            ->where('notifications.delete_user' , '=' , 0)
            ->orderBy('notifications.id', 'DESC')
            ->get();
        if ($notifications) {
            $unreadNotificationCount = Notification::where('read_user', 0)->where('user_id' ,auth()->id() )
                ->count();
            return response()->json(['notifications' => $notifications , 'count'=>$unreadNotificationCount] , 200);
        }
        else {
            return response()->json(['msg' => 'Không có dữ liệu'] , 400);
        }
    }

    public function getNotificationDoctor()
    {
        $notifications = Notification::where('doctor_id', auth()->guard('doctors')->id())
            ->select('notifications.doctor_id as id' , 'doctors.image as avatar' ,
                'doctors.name' , 'notifications.message_doctor as message'
            , 'notifications.id as id_notification' , 'notifications.appointment_id')
            ->join('doctors' , 'doctors.id' , '=' , 'notifications.doctor_id')
            ->where('notifications.message_doctor' , '!=' , '')
            ->where('notifications.delete_doctor' , '=' , 0)
            ->orderBy('notifications.id', 'DESC')
            ->get();
        if ($notifications) {
            $unreadNotificationCount = Notification::where('read_doctor', 0)->where('doctor_id' ,auth()->guard('doctors')->id() )
                ->count();
            return response()->json(['notifications' => $notifications , 'count'=>$unreadNotificationCount] , 200);
        }
        else {
            return response()->json(['msg' => 'Không có dữ liệu'] , 400);
        }
    }

    public function updateNotification() {
        if(Auth::guard('doctors')->check()) {
            $notifications = Notification::where('doctor_id', auth()->id())
                ->where('read_doctor', 0)
                ->update(['read_doctor' => 1]);
            if ($notifications !== false) {
                return response()->json(['notifications' => $notifications], 200);
            } else {
                return response()->json(['msg' => 'Không có dữ liệu cần cập nhật'], 400);
            }
        }
        elseif (Auth::check()) {
            $notifications = Notification::where('user_id', auth()->id())
                ->where('read_user', 0)
                ->update(['read_user' => 1]);
            if ($notifications !== false) {
                return response()->json(['notifications' => 'đã update thành công'], 200);
            } else {
                return response()->json(['msg' => 'Không có dữ liệu cần cập nhật'], 400);
            }
        }
    }

    public function deleteNotification($id) {
        if(Auth::guard('doctors')->check()) {
            $notifications = Notification::where('id', $id)->where('delete_doctor' , 0)->first();
            if($notifications) {
                $notifications->update(['delete_doctor' => 1]);
                $notifications_update = Notification::where('doctor_id', auth()->guard('doctors')->id())
                    ->select('notifications.doctor_id as id' , 'doctors.image as avatar' , 'doctors.name' , 'notifications.message_doctor as message')
                    ->join('doctors' , 'doctors.id' , '=' , 'notifications.doctor_id')
                    ->where('notifications.message_doctor' , '!=' , '')
                    ->where('notifications.delete_doctor' , '=' , 0)
                    ->orderBy('notifications.id', 'DESC')
                    ->get();
                return response()->json(
                    [
                        'msg' => 'đã xóa thành công' ,
                        'notification' =>$notifications_update
                    ] ,
                    200);
            }
            return response()->json(['msg' => 'Không có dữ liệu để xóa'] , 400);
        }
        elseif (Auth::check()) {
            $notifications = Notification::where('id', $id)->where('delete_user' , 0)->first();
            if($notifications) {
                $notifications->update(['delete_user' => 1]);
                $notifications_update = Notification::where('user_id', auth()->id())
                    ->select('notifications.user_id as id' , 'users.avatar' , 'users.name' , 'notifications.message'
                        , 'notifications.id as id_notification')
                    ->join('users' , 'users.id' , '=' , 'notifications.user_id')
                    ->where('notifications.message' , '!=' , '')
                    ->where('notifications.delete_user' , '=' , 0)
                    ->orderBy('notifications.id', 'DESC')
                    ->get();
                return response()->json(
                    [
                        'msg' => 'đã xóa thành công',
                        'notification' =>  $notifications_update
                    ] , 200
                );
            }
            return response()->json(['msg' => 'Không có dữ liệu cần xóa'] , 400);
        }
    }


}
