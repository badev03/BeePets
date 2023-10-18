<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index() {
        return view('admin.notification.index');
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
}
