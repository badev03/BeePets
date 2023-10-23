<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Products;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use App\Models\bill_prescription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Prescription_product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            $appointments = Appointment::select('doctors.name', 'doctors.image', 'appointments.id', 'appointments.date', 'appointments.time', 'appointments.status', 'appointments.shift_name', 'appointments.created_at as appointment_created_at')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->where('appointments.user_id', $id)
                ->where('appointments.doctor_id', $doctor_id)
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


    public function getAppiontmentByID($id)
    {
        if (Auth::guard('doctors')->check()) {
            $doctor_id = Auth::guard('doctors')->user()->id;
            $appointment = Appointment::where('appointments.id', $id)
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->join('bills', 'bills.appointment_id', '=', 'appointments.id')
                ->join('services', 'services.id', '=', 'appointments.service_id')
                ->select(
                    'appointments.id',
                    'users.name as user_name',
                    'doctors.name as doctor_name',
                    'appointments.date',
                    'bills.total_amount',
                    'appointments.status as appointment_status',
                    'doctors.status as doctor_status',
                    'appointments.created_at as appointment_created_at',
                    'appointments.shift_name',
                    'doctors.image as doctor_image',
                    'appointments.description',
                    'services.name as service_name'
                )
                ->first();
            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin cuoc hen thành công',
                'appointment' => $appointment
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
                ->select('bills.id', 'bills.code as bill_code', 'bills.created_at as bill_created_at', 'doctors.name as doctor_name', 'bills.total_amount', 'bills.status as bill_status')
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
                $bill->payment_method = 1;
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
    public function updateBill(Request $request, $id)
    {
        $validator = $this->validateUpdateBillRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }
        if (Auth::guard('doctors')->check()) {


            $bill = Bill::query()->find($id);

            if (!$bill) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy hóa đơn',
                ], 404);
            }
            $prescription = $this->createPrescription($request->name, $request->price, $request->doctor_id, $request->user_id, $request->bill_id);

            $prescription_id = $prescription->id;



            foreach ($request->products as $product) {
                Prescription_product::create([
                    'prescription_id' => $prescription_id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price_product'],
                    'instructions' => $product['instructions'],
                ]);
            }

            $total_amount = $bill->total_amount + $request->price;
            $bill->total_amount = $total_amount;
            $bill->description = $request->description;
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
    public function createPrescription($name, $price, $doctor_id, $user_id, $bill_id)
    {

        $prescription = new Prescription();
        $prescription->name = $name;
        $prescription->price = $price;
        $prescription->doctor_id = $doctor_id;
        $prescription->user_id = $user_id;
        $prescription->bill_id = $bill_id;
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

    public function validateUpdateBillRequest(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required|numeric',
        'doctor_id' => 'required|exists:doctors,id',
        'user_id' => 'required|exists:users,id',
        'bill_id' => 'required|exists:bills,id',
        'products' => 'required|array',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|numeric',
        'products.*.price_product' => 'required|numeric',
        'products.*.instructions' => 'required',
    ]);

    return $validator;
}

    //detail bill by id
    public function detailBill($id)
    {
        try {
            if (Auth::guard('doctors')->check()) {

                $bill = Bill::where('bills.id', $id)
                    ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                    ->join('services', 'services.id', '=', 'appointments.service_id')
                    ->join('users', 'users.id', '=', 'bills.user_id')
                    ->join('doctors', 'doctors.id', '=', 'bills.doctor_id')
                    ->join('prescriptions', 'prescriptions.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.code',
                        'bills.created_at as bill_created_at',
                        'bills.total_amount',
                        'bills.status as bill_status',
                        'users.name as user_name',
                        'users.phone as user_phone',
                        'users.avatar as avatar',
                        'doctors.name as doctor_name',
                        'bills.description',
                        'prescriptions.name', 'prescriptions.price',
                    )
                    ->first();

                $prescription = DB::table('prescriptions')
                    ->join('prescription_product', 'prescription_product.prescription_id', '=', 'prescriptions.id')
                    ->join('products', 'products.id', '=', 'prescription_product.product_id')
                    ->select( 'products.name as product_name', 'prescription_product.quantity', 'prescription_product.price as price_product', 'prescription_product.instructions')
                    ->where('prescriptions.bill_id', $id)
                    ->get();
                $services = DB::table('services')
                    ->join('appointments', 'appointments.service_id', '=', 'services.id')
                    ->join('bills', 'bills.appointment_id', '=', 'appointments.id')
                    ->where('bills.id', $id)
                    ->select('services.name', 'services.price', 'appointments.date', 'appointments.time', 'appointments.shift_name', 'appointments.description')
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => 'Lấy thông tin hóa đơn thành công',
                    'bill' => $bill,
                    'prescription' => $prescription,
                    'services' => $services
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
}
