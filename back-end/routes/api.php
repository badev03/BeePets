<?php

use App\Http\Controllers\Api\BookingController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ServiceController;
use \App\Http\Controllers\Api\ReviewsController;
use \App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\NewController;
use App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\DoctorUserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$objects = [
    'service' => ServiceController::class,
    'reviews' => ReviewsController::class,
    'new' => NewController::class,
    'doctors-clients' => DoctorUserController::class,
];
foreach ($objects as $key => $controller) {
    Route::apiResource($key, $controller);
}
Route::get('service-show', [ServiceController::class , 'showHome']);
Route::get('service-filter', [ServiceController::class , 'filterService']);
Route::post('service-filter-doctor', [ServiceController::class , 'filterDoctorService']);
Route::get('new-post', [NewController::class , 'postNew']);
Route::get('new-post/{id}', [NewController::class , 'postNewShow']);
Route::get('new-categories', [NewController::class , 'categoriesNew']);
Route::get('new-search/{name}', [NewController::class , 'searchNew']);
Route::get('new-home', [NewController::class , 'showNew']);


Route::get('service-show', [ServiceController::class, 'showHome']);
Route::get('service-filter', [ServiceController::class, 'filterService']);
Route::post('service-filter-doctor', [ServiceController::class, 'filterDoctorService']);
Route::get('new-post', [NewController::class, 'postNew']);
Route::get('new-categories', [NewController::class, 'categoriesNew']);
Route::get('new-search/{name}', [NewController::class, 'searchNew']);
Route::get('new-home', [NewController::class, 'showNew']);



Route::post('/doctor/login', [DoctorController::class, 'login']);


Route::post('send-opt-login', [AuthController::class, 'sendOtp']);
Route::post('check-phone', [AuthController::class, 'checkerPhone'])->name('check-phone');
Route::post('login-user', [AuthController::class, 'LoginUserOtp']);
Route::post('check-verify', [AuthController::class, 'CheckVerify'])->name('check-verify');
Route::post('check-verify-register', [AuthController::class, 'CheckVerifyRegister']);
Route::post('check-login', [AuthController::class, 'CheckLogin']);
Route::get('logout-user', [AuthController::class, 'LogoutUser']);
Route::post('register-user', [AuthController::class, 'RegisterUser']);
Route::post('forget-password', [AuthController::class, 'ForgetPassWord']);
Route::post('check-verify-forget-password', [AuthController::class, 'CheckVerifyForgetPassword']);
Route::post('reset-password', [AuthController::class, 'ResetPassword']);











//lấy ra danh sách dịch vụ và các bác sĩ làm được dịch vụ đó
Route::get('/services-doctor', [BookingController::class, 'services']);
//lấy ra danh sách loại thú cưng
Route::get('/type-pets', [BookingController::class, 'typePets']);
//lấy ra danh sách bác sĩ theo dịch vụ và ngày
Route::post('/doctors-service', [BookingController::class, 'doctors']);
//lấy ra danh sách lịch làm việc của bác sĩ
Route::get('/work-schedule', [BookingController::class, 'workSchedule']);
//thêm tên và số điện thoại của khách hàng
Route::post('/infor-customer', [BookingController::class, 'addNamePhone']);
// lưu dữ liệu đã chọn vào bảng appointment
Route::post('/save', [BookingController::class, 'save']);

//thêm lịch khám
Route::post('/add-booking', [BookingController::class, 'addBooking']);

//lấy tất cả các lịch khám đã được chấp nhận
Route::get('/appoinments', [BookingController::class, 'getAppointments']);
//lấy ra các lịch khám trạng thái chưa xác nhận
Route::get('/appoinments-status', [BookingController::class, 'getAppointmentByStatus']);

//lấy ra 1 lịch khám
Route::get('/appoinment/{id}', [BookingController::class, 'getAppointment']);

//câp nhật trạng thái lịch khám
Route::put('/appoinment/{id}', [BookingController::class, 'updateStatus']);

//lấy ra thông tin bác sĩ đang đăng nhập
Route::get('/doctor-info', [DoctorController::class, 'getDoctor']);

//lấy ra danh sách khách hàng của bác sĩ
Route::get('/list-customers', [DoctorController::class, 'listCustomer']);

//lấy ra lịch sử khám của khách hàng
Route::get('/history/{id}', [DoctorController::class, 'getHistoryByUser']);
