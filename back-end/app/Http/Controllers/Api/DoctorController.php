<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Service;
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
                    ->select('users.id', 'users.name', 'users.avatar', 'users.phone', 'users.email', 'users.address')
                    ->distinct()
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
            $appointments = Appointment::select('doctors.name', 'doctors.image', 'appointments.id', 'appointments.date', 'appointments.time', 'appointments.status', 'appointments.shift_name', 'appointments.created_at as appointment_created_at', 'bills.code')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->join('bills', 'appointments.id', '=', 'bills.appointment_id')
                ->where('appointments.user_id', $id)
                ->where('appointments.doctor_id', $doctor_id)
                ->orderBy('appointments.created_at', 'desc')
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
                ->leftJoin('bills', 'bills.appointment_id', '=', 'appointments.id')
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
            $doctor_id = Auth::guard('doctors')->user()->id;
            $result = DB::table('bills')
                ->select('bills.id', 'bills.code as bill_code', 'bills.created_at as bill_created_at', 'doctors.name as doctor_name', 'bills.total_amount', 'bills.status as bill_status')
                ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->where('appointments.user_id', $id)
                ->where('appointments.doctor_id', $doctor_id)
                ->orderBy('bills.created_at', 'desc')
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
                ->join('doctors', 'doctors.id', '=', 'prescriptions.doctor_id')
                ->select(
                    'prescriptions.id',
                    'prescriptions.created_at as prescription_created_at',
                    'doctors.name as doctor_name',
                    'doctors.image as doctor_image',
                    'prescriptions.name as prescription_name',
                    'prescriptions.price as prescription_price'
                )
                ->where('prescriptions.user_id', $id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách đơn thuốc thành công',
                'prescriptions' => $result
            ]);
        }
    }


    public function detailPrescription($id)
    {

        $doctor_id = auth()->user()->id;
        $prescription = Prescription::where('doctor_id', $doctor_id)
            ->with('doctor:id,name', 'user:id,name')
            ->where('id', $id)
            ->get();
        // dd($prescription);
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
            'prescription' => $prescription,
            'prescription_product' => $result
        ]);
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

    public function createBill($appointmentId, $doctorId, $userId, $service_price)
    {
        try {
            if (Auth::guard('doctors')->check()) {
                $code = 'HĐ' . rand(100000, 999999);
                $bill = new Bill();
                $bill->code = $code;
                $bill->appointment_id = $appointmentId;
                $bill->doctor_id = $doctorId;
                $bill->user_id = $userId;
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
            $existingPrescription = Prescription::where('bill_id', $bill->id)->first();
            if ($existingPrescription) {
                $prescription = $existingPrescription;
            } else {
                // Nếu không, tạo mới đơn thuốc
                $prescription = $this->createPrescription($request->name, $request->price, $request->doctor_id, $request->user_id, $request->bill_id);
            }


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
            $total_amount = 0;

            $addedServices = []; // Mảng tạm thời lưu trữ các service_id đã được thêm vào
            foreach ($request->services as $service) {
                $selectedService = Service::find($service['service_id']);
                if ($selectedService) {
                    $appointment = Appointment::find($bill->appointment_id);

                    if ($appointment) {
                        // Kiểm tra trùng lặp trong trường group_service_id của bảng appointments
                        $groupServiceIds = explode(',', $appointment->group_service_id);
                        if (in_array($service['service_id'], $groupServiceIds)) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Dịch vụ đã tồn tại trong cuộc hẹn',
                            ], 400);
                        }

                        // Kiểm tra trùng lặp trong bảng bill_service
                        if ($bill->services()->where('service_id', $service['service_id'])->exists()) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Dịch vụ đã tồn tại trong hóa đơn',
                            ], 400);
                        }

                        // Cộng giá của dịch vụ vào total_amount

                        if (is_array($service['service_id'])) {
                            foreach ($service['service_id'] as $id) {
                                $bill->services()->attach($id); // Thêm dịch vụ vào hóa đơn
                                $total_amount += $selectedService->price;
                            }
                        } else {
                            $id = $service['service_id'];
                            $bill->services()->attach($id); // Thêm dịch vụ vào hóa đơn
                            $total_amount += $selectedService->price;
                        }





                        // Cập nhật trường group_service_id trong bảng appointments
                        $groupServiceIds[] = $service['service_id'];
                        $appointment->group_service_id = implode(',', $groupServiceIds);
                        $appointment->save();
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Không tìm thấy cuộc hẹn',
                        ], 404);
                    }
                }
            }




            $total_amount += $request->price; // Cộng giá sản phẩm vào total_amount
            $bill->total_amount += $total_amount;

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
            // 'doctor_id' => 'required|exists:doctors,id',
            // 'user_id' => 'required|exists:users,id',
            // 'bill_id' => 'required|exists:bills,id',
            'services' => 'required|array',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric',
            'products.*.price_product' => 'required|numeric',
            'products.*.instructions' => 'required',
        ]);

        return $validator;
    }





    public function detailBillDoctor($id)
    {
        try {
            if (Auth::guard('doctors')->check()) {
                $doctorId = Auth::guard('doctors')->user()->id;
    
                $bill = Bill::select(
                    'bills.id',
                    'bills.code',
                    'bills.description',
                    'bills.total_amount',
                    'bills.status',
                    'bills.payment_method',
                    'bills.transaction_type',
                    'bills.created_at',
                    'bills.user_id',
                    'bills.doctor_id',
                    'bills.appointment_id',

                )->with(['appointment.user' => function ($query) {
                    $query->select('id', 'name');
                }, 'doctor:id,name', 'prescriptions.productss:id,name,price'])
                    ->where('id', $id)
                    ->where('doctor_id', $doctorId)
                    ->first();
    
                if (!$bill) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy hóa đơn',
                    ]);
                }
    
                $groupServiceIds = explode(',', $bill->appointment->group_service_id);
    
                $services = Service::select('id', 'name', 'price')
                    ->whereIn('id', $groupServiceIds)
                    ->get();
    
              
    
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy thông tin hóa đơn thành công',
                    'bill' => $bill,
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
                'message' => 'Đã xảy ra lỗi',
                'error' => $exception->getMessage()
            ]);
        }
    }
    

}
