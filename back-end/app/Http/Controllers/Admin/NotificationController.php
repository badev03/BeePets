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

class NotificationController extends Controller
{
    use QueryCommon;
    public $title_web = 'Hệ thống thông báo';
    public $urlbase = 'notifications.';
    public function index() {

        return view('admin.notification.index' )->with(
            [
                'title_web'=>$this->title_web,
                'urlbase'=>$this->urlbase,
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
            $messageUser->sendManyDoctor($request->id , $request->description);
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
}
