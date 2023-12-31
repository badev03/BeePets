<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\NewController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\InforController;
use \App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\AppointmentImport;
use App\Http\Controllers\Api\BookingController;
use \App\Http\Controllers\Api\ReviewsController;
use \App\Http\Controllers\Api\ServiceController;
use \App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\statisticController;
use App\Http\Controllers\Api\BookingHaiController;
use \App\Http\Controllers\Api\DoctorUserController;
use App\Http\Controllers\Api\BillControllerHistory;
use \App\Http\Controllers\Api\NotificationController;
use \App\Http\Controllers\Api\FilterAppointmentController;
use \App\Http\Controllers\Api\StatisticsAppointmentController;
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
Route::get('service-show', [ServiceController::class, 'showHome']);
Route::get('service-filter', [ServiceController::class, 'filterService']);
Route::post('service-filter-doctor', [ServiceController::class, 'filterDoctorService']);
Route::get('new-post/{name?}', [NewController::class, 'postNew']);
Route::get('new-categories', [NewController::class, 'categoriesNew']);
Route::get('new-home', [NewController::class, 'showNew']);
Route::get('doctor-home-user', [DoctorUserController::class, 'DoctorHomeUser']);
Route::get('setting', [SettingController::class, 'index']);

Route::post('/doctor/login', [DoctorController::class, 'login']);


Route::post('check-phone', [AuthController::class, 'checkerPhone'])->name('check-phone');
Route::post('check-verify', [AuthController::class, 'CheckVerify'])->name('check-verify');

Route::post('check-login', [AuthController::class, 'CheckLogin']);

Route::post('check-verify-register', [AuthController::class, 'CheckVerifyRegister']);
Route::post('register-user-password', [AuthController::class, 'CreatePassword']);

Route::post('register-user', [AuthController::class, 'RegisterUser']);

Route::post('forget-password', [AuthController::class, 'ForgetPassWord']);
Route::post('check-verify-forget-password', [AuthController::class, 'CheckVerifyForgetPassword']);
Route::post('change-password/{phone}', [AuthController::class, 'ChangePassword']);
Route::post('reset-password/{phone}', [AuthController::class, 'ResetPassword']);

Route::post('login-user', [AuthController::class, 'LoginUserOtp']); //test thôi

Route::post('give-password-new/{phone}', [AuthController::class, 'ForGetPasswordUser']);
Route::post('register-password-new/{phone}', [AuthController::class, 'RegisterUserOtp']);


//lấy ra danh sách dịch vụ
Route::get('/services-doctor', [BookingController::class, 'services']);
//lấy ra danh sách loại thú cưng
Route::get('/type-pets', [BookingController::class, 'typePets']);
//lấy ra danh sách bác sĩ theo dịch vụ
Route::post('/doctors-service', [BookingController::class, 'doctors']);
//lấy ra danh sách lịch làm việc của bác sĩ
Route::get('/work-schedule', [BookingController::class, 'workSchedule']);

Route::post('/doctor-service', [BookingController::class, 'doctorService']);
// Route::post('/booking2',[Booking2Controller::class,'save']);
// lưu dữ liệu đã chọn vào bảng appointment
Route::post('/save', [BookingController::class, 'save']);

//thêm lịch khám
Route::post('/add-booking', [BookingController::class, 'addBooking']);

Route::middleware('auth:sanctum')->group(function () {

Route::get('get-products', [DoctorController::class, 'getProducts']);

Route::get('get-services', [DoctorController::class, 'getServices']);

Route::post('update-bill/{id}', [DoctorController::class, 'updateBill']);



    Route::get('pusher-tester', [\App\Http\Controllers\Admin\HomeController::class, 'Pusher']);
    // get info user when login
    Route::get('/info-user', [UserController::class, 'getInfoUser']);
    //change password user
    Route::put('/change-password-user', [UserController::class, 'changePasswordUser']);
    //logout user
    Route::post('/logout-user', [UserController::class, 'logoutUser']);
    //get appointment by user
    Route::get('/appointment-user', [UserController::class, 'getAppiontment']);
    //get prescription by user
    Route::get('/prescription-user', [UserController::class, 'prescriptionByUser']);
    //get bill by user
    Route::get('/bill-user', [UserController::class, 'billByUser']);
    //get history by user
    Route::get('/history-user', [UserController::class, 'getHistoryByUser']);


    Route::get('/appointments-filter', [UserController::class, 'filterAppointments']);

    //lấy ra các lịch khám trạng thái chưa xác nhận
    Route::get('/appoinments-status', [BookingController::class, 'getAppointmentByStatus']);


    Route::get('/infor-member', [BookingController::class, 'inforMember']);

    //lấy ra 1 lịch khám
    Route::get('/appoinment/{id}', [BookingController::class, 'getAppointment']);
    // lấy ra danh sách lịch khám của bác sĩ đã được chấp nhận
    Route::get('/list-appiontment-doctor', [BookingController::class, 'getAppointmentAccept']);
    //câp nhật trạng thái lịch khám
    Route::put('/update-appointment/{id}', [BookingController::class, 'updateStatus']);

    Route::post('/update-service/{id}', [DoctorController::class, 'updateService']);
    //lấy ra thông tin bác sĩ đang đăng nhập
    Route::get('/doctor-info', [DoctorController::class, 'getDoctor']);
    Route::post('/save-infor-user', [InforController::class, 'saveInfor']);

    //lấy ra danh sách khách hàng của bác sĩ
    Route::get('/list-customers', [DoctorController::class, 'listCustomer']);

    //lấy ra khách hàng của bác sĩ theo id
    Route::get('/get-customer/{id}', [DoctorController::class, 'getCustomerByID']);

    Route::get('/detail-prescription/{id}', [UserController::class, 'detailPrescription']);
    Route::get('/detail-bill-user/{id}', [UserController::class, 'detailBill']);
    Route::get('/detail-bill/{id}', [DoctorController::class, 'detailBillDoctor']);
    Route::get('/detail-prescription-doctor/{id}', [DoctorController::class, 'detailPrescription']);

    //lấy ra lịch sử khám của khách hàng
    // Route::get('/history/{id}', [DoctorController::class, 'getHistoryByUser']);

    Route::get('reviews', [ReviewsController::class, 'store']);
    Route::post('logout', [AuthController::class, 'LogoutUser']);


    Route::get('/get-notification',  [NotificationController::class, 'getNotification']);
    Route::get('/get-notification-doctor',  [NotificationController::class, 'getNotificationDoctor']);
    Route::post('/send-notification',  [\App\Http\Controllers\Admin\HomeController::class, 'SendNotification']);
    Route::get('get-list-history',  [BillControllerHistory::class, 'index']);
    Route::get('get-list-history-bill',  [BillControllerHistory::class, 'billHistory']);
    Route::get('update-read-notification',  [NotificationController::class, 'updateNotification']);
    Route::delete('delete-read-notification/{id}',  [NotificationController::class, 'deleteNotification']);

    Route::post('filter-appointments',  [FilterAppointmentController::class, 'index']);
    Route::post('filter-appointments-statistics',  [StatisticsAppointmentController::class, 'index']);
});

Route::get('statistic-type-pet', [statisticController::class, 'statisticPetType']);
Route::post('statistic-type-pet', [statisticController::class, 'statisticPetTypeByDate']);

Route::get('statistic-service', [statisticController::class, 'statisticService']);
Route::post('statistic-service', [statisticController::class, 'statisticServiceByDate']);
Route::post('import-appointments',[AppointmentImport::class,'import']);


// xem lich hen cua user tu ben bac si
Route::get('/list-appiontment/{id}', [DoctorController::class, 'getAppiontment']);
// xem chi tiết lịch hẹn  khách hàng của bác sĩ
Route::get('/get-appiontment/{id}', [DoctorController::class, 'getAppiontmentByID']);

// xem chi tiết lịch hẹn của user

Route::get('/get-appointment-user/{id}', [UserController::class, 'getAppiontmentByID']);

//change password doctor
Route::put('/change-password', [DoctorController::class, 'changePassword']);


//get bills
Route::get('/bills/{id}', [DoctorController::class, 'billByUser']);
//get detail bill

//  bác sĩ xem đơn thuốc chi tiết khác hàng
Route::get('/prescription/{id}', [DoctorController::class, 'prescriptionByUser']);


//change password doctor
Route::put('/change-password', [DoctorController::class, 'changePassword']);

Route::get('about', [AboutController::class, 'index']);

//get review when doctor login
Route::get('/reviews-doctor', [DoctorController::class, 'getReviewDoctor']);


Route::get('pusher-tester-view', [\App\Http\Controllers\Admin\HomeController::class, 'PusherView']);


Route::get('check-api-notification', [\App\Http\Controllers\Admin\HomeController::class, 'pusherApi']);

