<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\bill_prescription;
use App\Models\Doctor;
use App\Models\Prescription_product;
use App\Models\Products;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BookingController;

class DoctorController extends Controller
{

    public function login(Request $request)
    {
        $request->validate(
            [
                'phone' => 'required',
                'password' => 'required'
            ],
            [
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]
        );
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
    public function getDoctor()
    {
        if (!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        } else {
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
            if (Auth::guard('doctors')->check()) {
                $doctor_id = Auth::guard('doctors')->user()->id;
                $customers = Appointment::where('doctor_id', $doctor_id)
                    ->join('users', 'users.id', '=', 'appointments.user_id')
                    ->select('users.id', 'users.name', 'users.phone', 'users.email', 'users.address')
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách khách hàng thành công',
                    'customers' => $customers
                ]);
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
    public function getCustomerByID($id)
    {
        try {
            if (Auth::guard('doctors')->check()) {
                $customer = Appointment::where('user_id', $id)
                    ->join('users', 'users.id', '=', 'appointments.user_id')
                    ->select('users.id', 'users.name', 'users.phone', 'users.email', 'users.address')
                    ->first();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy thông tin khách hàng thành công',
                    'customer' => $customer
                ]);
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

    public function changePassword(Request $request)
    {
        try {
            $request->validate(
                [
                    'old_password' => 'required',
                    'new_password' => 'required',
                    'confirm_password' => 'required'
                ],
                [
                    'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
                    'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                    'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới'
                ]
            );
            if (Auth::guard('doctors')->check()) {
                $doctor = Auth::guard('doctors')->user();
                $doctor->password = Hash::make(request()->new_password);
                $doctor->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Đổi mật khẩu thành công',
                    'doctor' => $doctor
                ]);
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
    public function billByUser($id)
    {
        if (Auth::guard('doctors')->check()) {
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
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }
    public function prescriptionByUser($id)
    {
        if (!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        } else {
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
    public function getReviewDoctor()
    {
        if (!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        } else {
            $doctor_id = Auth::guard('doctors')->user()->id;
            $result = DB::table('reviews')
                ->select('reviews.content', 'reviews.created_at', 'users.name as user_name', 'reviews.score')
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

    public function createBill($appointmentId, $doctorId, $userId, $serviceId, $service_price)
    {
        try {
            if (Auth::guard('doctors')->check()) {
                $code = 'HĐ' . rand(100000, 999999);
                $bill = new Bill();
                $bill->code = $code;
                $bill->appointment_id = $appointmentId;
                $bill->doctor_id = $doctorId;
                $bill->user_id = $userId;
                $bill->service_id = $serviceId;
                $bill->status = 0;
                $bill->transaction_type = 1;
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
    public function updateBill(Request $request,$id)
    {

        if (Auth::guard('doctors')->check()) {


            $bill = Bill::query()->find($id);

          
            $prescription = $this->createPrescription($request->name, $request->price, $request->doctor_id, $request->user_id);

            $prescription_id = $prescription->id;

        
            Prescription_product::create([
                'prescription_id' => $prescription_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price_product,
            ]);
           
            $bill_prescription = bill_prescription::create([
                'bill_id' => $bill->id,
                'prescription_id' => $prescription_id
            ]);
            $bill_prescription_id = $bill_prescription->id;
            $bill->bill_prescription_id = $bill_prescription_id;

            $bill->save();
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật hóa đơn thành công',
                'bill' => $bill
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }
    // tạo đơn thuốc cho bảng prescription_product và lưu vào bảng perscription
    public function createPrescription($name, $price, $doctor_id, $user_id)
    {

        $prescription = new Prescription();
        $prescription->name = $name;
        $prescription->price = $price;
        $prescription->doctor_id = $doctor_id;
        $prescription->user_id = $user_id;
        $prescription->save();

        return $prescription;
    }



    public function getProducts()
    {
        if (Auth::guard('doctors')->check()) {
            $products = Products::select('id', 'name', 'price')->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách sản phẩm thành công',
                'products' => $products
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }

    public function getServices()
    {
        // lấy ra dịch vụ theo id của bác sĩ
        if (Auth::guard('doctors')->check()) {
            $doctor_id = Auth::guard('doctors')->user()->id;
            $services = Doctor::where('doctors.id', $doctor_id)
                ->join('doctor_service', 'doctor_service.doctor_id', '=', 'doctors.id')
                ->join('services', 'services.id', '=', 'doctor_service.service_id')
                ->select('services.id', 'services.name', 'services.price')
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách dịch vụ thành công',
                'services' => $services
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }
}
