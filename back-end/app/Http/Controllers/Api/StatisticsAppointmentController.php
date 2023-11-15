<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsAppointmentController extends Controller
{
    /*
     * Writter statitics appointment defaut
     * */

    public function index(Request $data) {
        if(Auth::guard('doctors')->check()) {
            $appointmentFilter = $this->baseQuery(Auth::guard('doctors')->id());
            $dateDefault = date('Y-m-d');
            $date_request = $data->date;
            if($data->has('date') || $data->has('period_date')) {
                if($data->has('date')){
                    $data2 =Appointment::where('doctor_id' , Auth::guard('doctors')->id())
                        ->whereDate('appointments.date' ,$date_request)
                        ->select('status', DB::raw('COUNT(*) as count'))
                        ->groupBy('status');
                }
                if($data->has('period_date')) {
                    if($data->period_date <= 0) {
                        $day = abs($data->period_date);
                        $range = Carbon::now()->subDays($day);
                    }
                    else {
                        $range = Carbon::now()->addDays($data->period_date);
                    }
                    $data2 = Appointment::where('doctor_id' , Auth::guard('doctors')->id())
                        ->select('appointments.status' , 'appointments.id' ,
                            'appointments.shift_name' , 'appointments.date' )
                        ->where('created_at', '>=', $range)
                        ->select('status', DB::raw('COUNT(*) as count'))
                        ->groupBy('status');
                }
                if($data2->get()->isEmpty()) {
                    $msg = 'Không có dữ liệu';
                }
                else{
                    $msg = 'Lọc dữ liệu thành công';
                }

                return response()->json([
                    'msg' => $msg,
                    'data' => $data2->get()
                ] , 200);
            }


            $data1 = $appointmentFilter->whereDate('appointments.date', $dateDefault);
            if($data1->get()->isEmpty()) {
                $msg = 'Không có dữ liệu';
            }
            else{
                $msg = 'Lọc dữ liệu thành công';
            }
            return response()->json([
                'msg' => $msg,
                'data' => $data1->get()
            ] , 200);
        }
        else {
            return response()->json([
                'msg' => 'Bạn không có quyền sử dụng api này ',
            ] , 401);
        }
    }

    public function baseQuery($id) {
        $query = Appointment::where('doctor_id' , $id)
//            ->whereIn('appointments.status' , [status_have_finish , status_request_change_work ,
//                status_request_cancel , status_have_delete , status_have_confirm , status_wait_confirm])
            ->select('appointments.status' , 'appointments.id' ,
                'appointments.shift_name' , 'appointments.date' );
        return $query;
    }
}
