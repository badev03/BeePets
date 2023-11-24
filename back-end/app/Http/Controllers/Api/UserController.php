<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Bill_service;
use App\Models\Prescription;
use App\Models\Prescription_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getInfoUser()
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy thông tin người dùng thành công',
                    'user' => $user
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function changePasswordUser(Request $request)
    {
        try {
            if (auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            } else {
                $user = auth()->user();
                $request->validate(
                    [
                        'password' => 'required',
                        'new_password' => 'required',
                        'confirm_password' => 'required|same:new_password'
                    ],
                    [
                        'password.required' => 'Vui lòng nhập mật khẩu',
                        'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                        'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
                        'confirm_password.same' => 'Mật khẩu nhập lại không chính xác'
                    ]
                );
                if (!Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Mật khẩu không chính xác'
                    ]);
                } else {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Đổi mật khẩu thành công'
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function logoutUser()
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            } else {
                auth()->logout();
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng xuất thành công'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    //get all appointment by user
    public function getAppiontment()
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            } else {
                $id = auth()->user()->id;
                $result = DB::table('appointments')
                    ->select('doctors.name as doctor_name', 'appointments.date', 'appointments.time', 'appointments.status', 'appointments.id as appointment_id')
                    ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                    ->where('appointments.user_id', $id)
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách lịch khám thành công',
                    'appointments' => $result
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function getAppiontmentByID($id)
    {
        try {
            $appiontment = Appointment::select(
                'users.name as user_name',
                'doctors.name as doctor_name',
                'doctors.image as doctor_image',
                'appointments.date',
                'appointments.time',
                'appointments.status',
                'appointments.id as appointment_id',
                'appointments.shift_name',
                'appointments.description',
                'appointments.reason_cancel',
                'type_pets.name as type_pet_name',
                'services.name as service_name',
            )
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->join('services', 'services.id', '=', 'appointments.service_id')

                ->where('appointments.id', $id)
                ->first();
            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin lịch khám thành công',
                'appointment' => $appiontment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function prescriptionByUser()
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            } else {
                //đang lỗi
                $user_id = auth()->user()->id;

                $result = DB::table('prescriptions')
                    ->select('prescriptions.id as prescription_id', 'prescriptions.created_at', 'doctors.name as created_by', 'prescriptions.price', 'doctors.image as doctor_image', 'prescriptions.name')
                    ->join('doctors', 'prescriptions.doctor_id', '=', 'doctors.id')
                    ->where('prescriptions.user_id', $user_id)
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách đơn thuốc thành công',
                    'prescriptions' => $result
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    public function detailPrescription($id)
    {

        $user_id = auth()->user()->id;
        $prescription = Prescription::select('id')->where('user_id', $user_id)->where('id', $id)->get();
        // lấy ra tên của sản phẩm trong bảng prescription_product
        if (count($prescription) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn thuốc'
            ]);
        }
        $result = DB::table('prescription_product')
            ->select('products.name as product_name', 'prescription_product.quantity', 'prescription_product.price', 'prescription_product.instructions')
            ->join('products', 'prescription_product.product_id', '=', 'products.id')
            ->where('prescription_product.prescription_id', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Lấy chi tiết đơn thuốc thành công',
            'products' => $result
        ]);
    }

    public function detailBill($id)
    {
        $user_id = auth()->user()->id;
        $bill = DB::table('bills')
            ->select('bills.id', 'bills.code', 'bills.created_at',
                'bills.status', 'bills.payment_method', 'bills.total_amount' , 'appointments.description'
            ,'doctors.image' , 'appointments.status')
            ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
            ->join('doctors', 'doctors.id', '=', 'bills.doctor_id')
            ->where('bills.user_id', $user_id)
            ->where('bills.id', $id)
            ->first();
        $bill_service = Bill_service::where('bill_id' , $id)
            ->join('services', 'services.id', '=', 'bill_service.service_id')->get();
        if (!$bill) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn thuốc'
            ]);
        }

        $products = DB::table('prescription_product')
            ->select('products.name as product_name', 'prescription_product.quantity', 'prescription_product.price as product_price')
            ->join('products', 'prescription_product.product_id', '=', 'products.id')
            ->join('prescriptions', 'prescription_product.prescription_id', '=', 'prescriptions.id')
            ->where('prescriptions.bill_id', $id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Lấy chi tiết đơn thuốc thành công',
            'bill' => $bill,
            'products' => $products,
            'bill_service' => $bill_service,
        ]);
    }
    public function billByUser()
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            } else {
                $id = auth()->user()->id;
                $result = DB::table('bills')
                    ->select('bills.id', 'bills.code', 'bills.created_at as order_date',
                        'doctors.name as created_by', 'bills.total_amount' , 'doctors.image')
                    ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
                    ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                    ->where('bills.user_id', $id)
                    ->orderByDesc('appointments.date')
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách hóa đơn thành công',
                    'bills' => $result
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function getHistoryByUser()
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            } else {
                $id = auth()->user()->id;
                $result = DB::table('appointments')
                    ->select('doctors.name as doctor_name', 'doctors.image', 'appointments.date', 'appointments.shift_name', 'appointments.status', 'appointments.id as appointment_id')
                    ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                    ->where('appointments.user_id', $id)
                    ->orderByDesc('appointments.date')
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách lịch khám thành công',
                    'appointments' => $result
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }


    public function getDoctor()
    {
    }
    public function filterAppointments(Request $request)
    {
        //nếu chưa đăng nhập
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        } else {
            // Lọc theo trạng thái
            $status = $request->input('status');
            $query = Appointment::query();

            if ($status) {
                $query->where('appointments.status', $status);
            }

            // Lọc theo ngày
            $date = $request->input('date');
            if ($date) {
                $query->whereDate('date', $date);
            }

            $shift_name = $request->input('shift_name');

            if ($shift_name) {
                $query->where('shift_name', $shift_name);
            }

            // Lọc theo khoảng thời gian
            $startTime = $request->input('start_time');
            $endTime = $request->input('end_time');
            if ($startTime && $endTime) {
                $query->whereBetween('time', [$startTime, $endTime]);
            }

            // Lọc theo dịch vụ
            $serviceId = $request->input('service_id');
            if ($serviceId) {
                $query->where('service_id', $serviceId);
            }

            // Lọc theo loại thú cưng
            $petTypeId = $request->input('type_pet_id');
            if ($petTypeId) {
                $query->where('type_pet_id', $petTypeId);
            }

            // Thực hiện truy vấn và trả về kết quả
            $appointments = $query->select('doctors.name as doctor_name', 'doctors.image',
                'appointments.date', 'appointments.shift_name',
                'appointments.status', 'appointments.id as appointment_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')->get();


            return response()->json($appointments);
        }
    }
}
