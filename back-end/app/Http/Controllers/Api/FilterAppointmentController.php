<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterAppointmentController extends Controller
{
    public function index(Request $data) {
        if(Auth::guard('doctors')->check()) {
            $appointmentFilter = $this->baseQuery(Auth::guard('doctors')->id());
            if($data->has('name')){
                $data1 = $appointmentFilter->where('users.name' , 'like' , '%'.$data->name.'%');
            }
            if($data->has('phone')) {
                $data1 = $appointmentFilter->where('users.phone' , 'like' , '%'.$data->phone.'%');
            }
            if ($data->has('status')) {
                $data1 = $appointmentFilter->where('appointments.status' , $data->status);
            }
            if ($data->has('date')) {
                $data1 = $appointmentFilter->whereDate('appointments.date' , $data->date);
            }
            if ($data->has('shift_name')) {
                $data1 = $appointmentFilter->where('appointments.shift_name' , $data->shift_name);
            }
            if(isset($data1)) {
                return response()->json([
                    'msg' => 'lọc dữ liệu thành công',
                    'data' => $data1->get()
                ] , 200);
            }
            else {
                return response()->json([
                    'msg' => 'Bạn có thể sử dụng bộ lọc',
                    'data' => []
                ] , 200);
            }
        }
        else {
            return response()->json([
                'msg' => 'Bạn không có quyền sử dụng api này ',
            ] , 401);
        }
    }

    public function baseQuery($id) {
        $query = Appointment::where('doctor_id' , $id)
            ->whereIn('appointments.status' , [status_have_finish , status_request_change_work ,
                status_request_cancel , status_have_delete , status_have_confirm])
            ->join('users' , 'users.id' , '=' , 'appointments.user_id' )
            ->select('appointments.status' , 'appointments.id' , 'users.name as nameUser' , 'users.phone as phoneUser' ,
                'appointments.shift_name' , 'appointments.date' , 'users.avatar');
        return $query;
    }
}
