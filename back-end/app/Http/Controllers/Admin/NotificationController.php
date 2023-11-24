<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Interfaces\MessageUser;
use App\Models\Notification;
use App\Traits\QueryCommon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class NotificationController extends Controller
{
    use QueryCommon;
    public $title_web = 'Hệ thống thông báo';
    public $urlbase = 'notifications.';
    public function index() {
        $queue = Queue::size('TimeLineNotification');
        return view('admin.notification.index' )->with(
            [
                'title_web'=>$this->title_web,
                'urlbase'=>$this->urlbase,
                'count_queue'=>$queue,
            ]
        );
    }

    public function storeBirthdayDoctor() {
        $doctors = DB::table('notifications')
            ->where('user_id', '=' , null )
            ->where('message', '=' , null )
            ->join('doctors' , 'doctors.id' , '=' , 'notifications.doctor_id')
            ->select('doctors.name' , 'notifications.id' , 'notifications.message_doctor' , 'notifications.created_at')
            ->get();
        return view('admin.notification.birthdayDoctor' , compact('doctors'));
    }
    public function destroy($id) {
        $doctors = Notification::find($id);
        if($doctors) {
            $doctors->delete();
            return back()->with(['success_delete'=>'Đã xóa thành công']);
        }
    }

    public function DoctorIndex() {
        return view('admin.notification.doctor' )->with(
            [
                'title_web'=>$this->title_web,
                'urlbase'=>$this->urlbase,
            ]
        );
    }

    public function SendNotificationUser(Request $request , MessageUser $messageUser)
    {
        if ($request->description==null) {
            return back()->with(['fails_msg' => 'Gửi thông báo không thành công bạn bắt buộc phải nhập nội dung gửi']);
        } else {
            $messageUser->sendManyUser($request->id , $request->description);
            return back()->with(['success_msg' => 'Đã gửi thông báo thành công']);
        }
    }

    public function SendNotificationDoctor(Request $request , MessageUser $messageUser) {
        if ($request->description==null) {
            return back()->with(['fails_msg' => 'Gửi thông báo không thành công bạn bắt buộc phải nhập nội dung gửi']);
        } else {
            $messageUser->sendManyDoctor($request->id , $request->description);
            return back()->with(['success_msg' => 'Đã gửi thông báo thành công']);
        }
    }

    public function TimeLine() {
        return view('admin.notification.time-line' )->with(
            [
                'title_web'=>$this->title_web,
                'urlbase'=>$this->urlbase,
            ]
        );
    }

    public function UpdateReadNotification(Request $request) {
        $unreadNotifications = Notification::where('read', 0)->get();

        foreach ($unreadNotifications as $notification) {
            $notification->update(['read' => 1]);
        }

        return response()->json(['message' => $unreadNotifications]);
    }

    public function NotificationNew(Request $request) {
        $page = $request->get('page', 1); // Lấy giá trị của 'page' từ request, mặc định là 1 nếu không có

        $notifications = Notification::select(
            'notifications.id',
            'users.name',
            'users.avatar',
            'message',
            'notifications.created_at',
            'notifications.appointment_id',
            'notifications.message_admin'
        )
            ->join('users', 'users.id', '=', 'notifications.user_id')
            ->whereNotNull('notifications.message_admin')
            ->orderBy('notifications.appointment_id', 'desc')
            ->paginate(5, ['*'], 'page', $page); // Phân trang với 5 bản ghi mỗi trang
        foreach ($notifications as $notification) {
            $notification->formatted_created_at = Carbon::parse($notification->created_at)->format('Y-m-d H:i:s');
        }

        return response()->json($notifications);
    }

    public function NotificationSms() {

        return back()->with(['success' => 'Đã gửi thông báo thành công']);
    }
}
