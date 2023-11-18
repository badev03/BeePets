<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\BookingController;
use \App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TypePetController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PeopleAccountController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ServiceCategorieController;
use App\Http\Controllers\Admin\AppointmentController;
use \App\Http\Controllers\Admin\ReviewController;
use \App\Http\Controllers\Admin\NewCategorieController;
use \App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use \App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\Admin\ExcelAppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//
Route::get('admin/statistic', [\App\Http\Controllers\Admin\StatisticController::class, 'index'])->name('statistic.index');
Route::get('admin/statistic/get-data', [\App\Http\Controllers\Admin\StatisticController::class, 'getByDate'])->name('statistic.getByDate');
Route::middleware(['role:Admin|Staff|User'])->group(function () {
    Route::prefix('admin')->group(function () {
        $objects = [
            'service-categories' => ServiceCategorieController::class,
            'service' => ServiceController::class,
            'product-categories' => ProductCategoryController::class,
            'products' => ProductController::class,
            'appointment' => AppointmentController::class,
            'reviews' => ReviewController::class,
            'type-pet' => TypePetController::class,
            'new-categories' => NewCategorieController::class,
            'new' => NewController::class,
            'notifications' => NotificationController::class,
            'about' => AboutController::class,
        ];
        foreach ($objects as $key => $controller) {
            Route::resource($key, $controller);
        }
        Route::middleware(['role:Admin'])->group(function () {
            Route::resource('role' , RoleController::class);
            Route::resource('people-account' , PeopleAccountController::class);
            Route::resource('permission' , PermissionController::class);
            Route::get('appointment-statistics', [AppointmentController::class , 'Statistics'])->name('appointments.statistics');
            Route::get('appointment-requirements-cancel', [AppointmentController::class , 'AppointmentCancelRequirements'])->name('appointments.cancel.requirements');
            Route::get('appointment-statistics/{day}', [AppointmentController::class , 'StatisticsDay'])->name('appointments.statistics.day');
            Route::get('appointment-statistics-date/{date}', [AppointmentController::class , 'StatisticsDate'])->name('appointments.statistics.date_time');
            Route::get('appointment-cancel/{id?}', [AppointmentController::class , 'AppointmentCancel'])->name('appointments.cancel');
            Route::put('notification-update', [NotificationController::class , 'UpdateReadNotification'])->name('notification.update');
            Route::put('change-doctor-admin/{id}', [AppointmentController::class , 'ChangeDoctorAdmin'])->name('appointments.change-doctor-admin');
            Route::delete('cancel-doctor-admin/{id}', [AppointmentController::class , 'CancelDoctorAdmin'])->name('appointments.cancel-doctor-admin');
            Route::get('wait-for-confirmation', [AppointmentController::class , 'WaitForConfirmation'])->name('appointments.wait-for-confirmation');
            Route::get('for-confirmation/{id}', [AppointmentController::class , 'ForConfirmation'])->name('appointments.for-confirmation');
            Route::get('for-confirmation-finished/{id}', [AppointmentController::class , 'ForConfirmationFinished'])->name('appointments.for-confirmation-finished');
            Route::get('history-appointment', [AppointmentController::class , 'ForHistoryAppointment'])->name('appointments.history-appointment');
            Route::get('bills-appointment/{id}', [AppointmentController::class , 'detailBills'])->name('appointments.detail-bills-appointment');
            Route::get('bills-appointment/', [AppointmentController::class , 'BillsAppointments'])->name('appointments.bills-appointment');
            Route::get('add-appointments/', [AppointmentController::class , 'AddAppointments'])->name('appointments.add-appointments');
            Route::get('testSMS/', [HomeController::class , 'testSMS']);
            Route::put('appointment-cart/{id}', [AppointmentController::class , 'billAppointmentAdd'])->name('appointments.add-appointments-bills');
            Route::get('appointment-clear-data/', [AppointmentController::class , 'clearAppointmentData'])->name('appointments.clear-appointment-data');
            // Route::get('profile', [AuthController::class , 'myProfile'])->name('myProfile');
             Route::get('excel-appointments', [ExcelAppointmentController::class , 'excelAppointment'])->name('excel.appointments');
        });
        Route::get('dashboard', [HomeController::class , 'index'])->name('dashboard');
        Route::get('appointment/get-day/{day}/{id}', [AppointmentController::class , 'getDay'])->name('appointment.get-day');
        Route::get('appointment/date-filter/{data}/{status?}', [AppointmentController::class , 'FilterDate'])->name('appointment.filter-date');
        Route::get('appointment/service-filter/{data}/{status?}', [AppointmentController::class , 'FilterService'])->name('appointment.filter-service');
        Route::get('appointment/doctor-filter/{data}/{status?}', [AppointmentController::class , 'FilterDoctor'])->name('appointment.filter-doctor');
        Route::get('appointment/time-appointments/{data}/{status?}', [AppointmentController::class , 'FilterTime'])->name('appointment.time');
        Route::post('appointment/date-search/', [AppointmentController::class , 'FilterSearch'])->name('appointment.filter-search');
        Route::post('appointment/date-search-phone/', [AppointmentController::class , 'FilterSearchPhone'])->name('appointment.filter-search-phone');
        Route::get('appointment/create-data/{data}', [AppointmentController::class , 'createData'])->name('appointment.create-data');
        Route::get('appointment/create-appointments/{data}', [AppointmentController::class , 'createData'])->name('create-data.appointments');
        Route::resource('schedules', ScheduleController::class);
        Route::resource('doctors', DoctorController::class);
        Route::post('/delete-image',[DoctorController::class,'deleteImage']);
        Route::get('pusher-tester-view' , [HomeController::class , 'PusherView']);
        Route::get('pusher-tester-view2' , [HomeController::class , 'PusherView2']);
        Route::get('trash-can/appointment' , [AppointmentController::class , 'TrashCan'])->name('appointments.trash-can');
        Route::delete('restore-trash/appointment/{id}' , [AppointmentController::class , 'RestoreTrash'])->name('appointments.restore-trash');
        Route::delete('birthDayDoctor/destroy/{id}' , [NotificationController::class , 'destroy'])->name('birthDayDoctor.destroy');
        Route::get('birthDayDoctor/notifications' , [NotificationController::class , 'storeBirthdayDoctor'])->name('notifications.birthdayDoctor');
        Route::get('doctors-notifications' , [NotificationController::class , 'DoctorIndex'])->name('notifications.doctor');
        Route::get('time-line-notifications' , [NotificationController::class , 'TimeLine'])->name('notifications.time-line-notifications');
        Route::get('profile' , [HomeController::class , 'Profile'])->name('profile');
        Route::post('send-notifications-user' , [NotificationController::class , 'SendNotificationUser'])->name('notifications.send-notifications-user');
        Route::post('send-notifications-doctor' , [NotificationController::class , 'SendNotificationDoctor'])->name('notifications.send-notifications-doctor');
        Route::match(['put' , 'get'] , 'setting' , [SettingController::class , 'index'])->name('setting');

        Route::get('my-profile' , [HomeController::class , 'myProfile'])->name('myProfile');


        Route::post('my-profile/change-password' , [HomeController::class , 'changePassword'])->name('myProfile.changePassword');

        Route::get('create-service/{id}' , [AppointmentController::class , 'getDoctor'])->name('get.doctor');
        Route::get('create-doctor-shift/{id}/{day}' , [AppointmentController::class , 'getShiftDoctor'])->name('get.shift.doctor');

        //carts
        Route::resource('carts', CartController::class);
        Route::get('/my-carts', [CartController::class, 'getCarts'])->name('carts.getCarts');
        Route::post('update-cart', [CartController::class, 'updateCart'])->name('carts.updateCart');
        Route::get('unset',[CartController::class, 'unsetCarts'])->name('carts.unset');
        Route::post('remove',[CartController::class, 'removeCart'])->name('carts.removeCart');
        //orders
        Route::get('checkout',[OrderController::class, 'checkout'])->name('checkout.index');
        Route::post('vn-pay',[OrderController::class, 'vnpay'])->name('checkout.vnpay');
        Route::get('vn-pay-return',[OrderController::class, 'vnpayReturn'])->name('checkout.vnpay_return');
        Route::post('momo-pay',[OrderController::class, 'momoPay'])->name('checkout.momo');
        Route::post('cash',[OrderController::class, 'cash'])->name('checkout.cash');
        Route::get('purchase',[OrderController::class, 'index'])->name('purchase.index');
        Route::patch('purchase',[OrderController::class, 'returnOrder'])->name('purchase.update');
        Route::get('purchase/{id}',[OrderController::class, 'show'])->name('purchase.show');
        //order
        Route::get('order',[OrderController::class, 'create'])->name('order.index');
        //print order
        Route::get('print-order/{id}',[OrderController::class, 'printOrder'])->name('print.order');
        //get data
        Route::get('get-data',[OrderController::class, 'getData'])->name('purchase.getData');
        //create new order
        Route::match(['get','post'],'create-order',[OrderController::class, 'createOrder'])->name('purchase.create');
        //get user by phone
//        Route::get('get-user',[OrderController::class, 'getUser'])->name('purchase.getUser');
        Route::get('get-user',[OrderController::class, 'getUser'])->name('purchase.getCustomerName');
        //get product
        Route::get('get-product/{id}',[OrderController::class, 'getProduct'])->name('purchase.getProduct');
        //getOrderByID
        Route::get('get-order/{id}',[OrderController::class, 'getOrderByID'])->name('purchase.getOrder');
        //updateByCash
        Route::post('update-order-cash',[OrderController::class, 'updateByCash'])->name('purchase.updateByCash');
        //updateByVnpay
        Route::post('update-order-vnpay',[OrderController::class, 'updateByVnpay'])->name('purchase.updateByVnpay');
        //return-vnpay
        Route::get('return-vnpay',[OrderController::class, 'returnVnpay'])->name('purchase.returnVnpay');
    });

});
Route::get('/', [BookingController::class, 'index'])->name('index');

Route::post('/booking', [BookingController::class, 'showForm'])->name('show.form');
Route::post('/booking-save', [BookingController::class, 'save'])->name('booking.store');



Route::get('/login', [\App\Http\Controllers\AuthController::class , 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class , 'loginPost'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\AuthController::class , 'formLogout'])->name('logout');

Route::get('admin/login', [\App\Http\Controllers\AuthController::class , 'index'])->name('admin.login');
Route::get('admin/logout', [\App\Http\Controllers\AuthController::class , 'logOut'])->name('admin.logout');
Route::post('admin/login', [\App\Http\Controllers\AuthController::class , 'checkLogin'])->name('admin.login.post');


Route::get('admin' , [HomeController::class , 'indexAdmin']);

Route::post('uploadImg' , [HomeController::class , 'uploadImg'])->name('checkEditor.upload');
Route::get('login-tester' , [ApiAuthController::class , 'checkPhone']);
Route::get('filter-service' , [\App\Http\Controllers\Api\ServiceController::class , 'filterServiceDoctor']);
Route::post('filter-service' , [\App\Http\Controllers\Api\ServiceController::class , 'filterServiceDoctorPost'])->name('filter-service-doctor');




Route::get('upload-image' , function () {
    return view('api.upload');
});
Route::post('upload-image' , [HomeController::class , 'upload'])->name('upload.image');
Route::get('pusher-tester' , [HomeController::class , 'Pusher']);
Route::get('queue-tester' , [HomeController::class , 'QueueTest']);
