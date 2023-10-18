<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BookingController;

class DoctorController extends Controller 
{
   
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ],
            [
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]);
       $doctor = Doctor::where('phone', $request->phone)->first();
       if (!Hash::check($request->password, $doctor->password)) {
           return response()->json([
               'success' => false,
               'message' => 'Mật khẩu không chính xác'
           ]);
       } else {
           return response()->json([
               'success' => true,
               'message' => 'Đăng nhập thành công',
               'access_token' => $doctor->createToken('auth_token')->plainTextToken,
               'token_type' => 'Bearer',
                'doctor' => $doctor
           ]);
       }
    }



    // lấy ra thông tin của bác sĩ  đã đăng nhập theo id
    public function getDoctor() {
        if(!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        }else{
            $doctor = Auth::guard('doctors')->user();
            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin bác sĩ thành công',
                'doctor' => $doctor
            ]);
        }

    }
    public function listCustomer()
    {
        try {
            if(Auth::guard('doctors')->check()) {
                $doctor_id = Auth::guard('doctors')->user()->id;
                $customers = Appointment::where('doctor_id', $doctor_id)
                    ->join('users', 'users.id', '=', 'appointments.user_id')
                    ->select('users.id','users.name', 'users.phone', 'users.email', 'users.address')
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách khách hàng thành công',
                    'customers' => $customers
                ]);
            } else{
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập',
                ]);
            }
        }catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function getCustomerByID($id) {
        try {
            if (Auth::guard('doctors')->check()) {
                $customer = Appointment::where('user_id', $id)
                    ->join('users', 'users.id', '=', 'appointments.user_id')
                    ->select('users.id','users.name', 'users.phone', 'users.email', 'users.address')
                    ->first();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy thông tin khách hàng thành công',
                    'customer' => $customer
                ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập',
                ]);
            }
        }catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function getAppiontment($id)
    {
        if (Auth::guard('doctors')->check()) {
            $doctor_id = Auth::guard('doctors')->user()->id;
            //Tên bác sĩ, Ngày đặt lịch, Tổng tiền, trạng thái của bác sĩ và user, $id là id của user
            $appointments = Appointment::where('appointments.user_id', $id)
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->join('bills', 'bills.appointment_id', '=', 'appointments.id')
                ->select('users.name as user_name', 'doctors.name as doctor_name', 'appointments.date', 'bills.total_amount', 'appointments.status as appointment_status', 'doctors.status as doctor_status')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách cuoc hen thành công',
                'appointments' => $appointments
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }

    public function changePassword(Request $request) {
        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
            ],
                [
                    'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
                    'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                    'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới']);
            if(Auth::guard('doctors')->check()) {
                $doctor = Auth::guard('doctors')->user();
                $doctor->password = Hash::make(request()->new_password);
                $doctor->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Đổi mật khẩu thành công',
                    'doctor' => $doctor
                ]);
            } else{
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập',
                ]);
            }
        }catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function billByUser($id) {
        if(Auth::guard('doctors')->check()) {
            $result = DB::table('bills')
                ->select('bills.code as bill_code', 'bills.created_at as bill_created_at', 'doctors.name as doctor_name', 'bills.total_amount')
                ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->where('appointments.user_id', $id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách hóa đơn thành công',
                'bills' => $result
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }
    public function prescriptionByUser($id) {
        if(!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }else {
            $doctor_id = Auth::guard('doctors')->user()->id;
            $result = DB::table('prescriptions')
                ->select('prescriptions.created_at as prescription_created_at', 'doctors.name as doctor_name', 'prescriptions.name as prescription_name')
                ->join('bills', 'bills.prescription_id', '=', 'prescriptions.id')
                ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->where('appointments.user_id', $id)
                ->where('doctors.id', $doctor_id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách đơn thuốc thành công',
                'prescriptions' => $result
            ]);
        }
    }
    public function getReviewDoctor() {
        if(!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }else {
            $doctor_id = Auth::guard('doctors')->user()->id;
            $result = DB::table('reviews')
                ->select('reviews.content', 'reviews.created_at', 'users.name as user_name','reviews.score')
                ->join('users', 'users.id', '=', 'reviews.user_id')
                ->where('reviews.doctor_id', $doctor_id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách đánh giá thành công',
                'reviews' => $result
            ]);
        }
    }






// tạo hóa đơn trống cho khách hàng

public function createBill($appointmentId, $doctorId, $userId,$serviceId,$service_price)
{
    try{
  if(Auth::guard('doctors')->check()) {
        $code ='HĐ' . rand(100000, 999999);
            $bill = new Bill();
            $bill->code = $code;
            $bill->appointment_id = $appointmentId;
            $bill->doctor_id = $doctorId;
            $bill->user_id = $userId;
            $bill->service_id = $serviceId;
            $bill->status = 0;
         
            $bill->total_amount = $service_price;
            $bill->save();

            return $bill;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    } catch (\Exception $exception) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi',
            'error' => $exception->getMessage()
        ]);
    }

}

// cập nhật các trường trong bill
public function updateBill(Request $request , $billId)
{
    try{
        if(Auth::guard('doctors')->check()) {
            $bill = Bill::where('id', $billId)->first();
            
            $bill->service_id = $serviceId;
            $bill->status = 0;
          
            $bill->description = $request->input('description');
            
            $bill->save();
          
            return $bill;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    } catch (\Exception $exception) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi',
            'error' => $exception->getMessage()
        ]);
    }

}
// thêm đơn thuốc cho khách hàng
public function createPrescription(Request $request)
{
    try{
        if(Auth::guard('doctors')->check()) {
        
           
           




        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    } catch (\Exception $exception) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi',
            'error' => $exception->getMessage()
        ]);
    }
}








}
