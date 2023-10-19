<?php

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
        ];
        foreach ($objects as $key => $controller) {
            Route::resource($key, $controller);
        }
        Route::middleware(['role:Admin'])->group(function () {
            Route::resource('role' , RoleController::class);
            Route::resource('people-account' , PeopleAccountController::class);
            Route::resource('permission' , PermissionController::class);
        });
        Route::get('dashboard', [HomeController::class , 'index'])->name('dashboard');
        Route::get('appointment/get-day/{day}/{id}', [AppointmentController::class , 'getDay'])->name('appointment.get-day');
        Route::get('appointment/date-filter/{data}', [AppointmentController::class , 'FilterDate'])->name('appointment.filter-date');
        Route::get('appointment/service-filter/{data}', [AppointmentController::class , 'FilterService'])->name('appointment.filter-service');
        Route::get('appointment/doctor-filter/{data}', [AppointmentController::class , 'FilterDoctor'])->name('appointment.filter-doctor');
        Route::get('appointment/time-appointments/{data}', [AppointmentController::class , 'FilterTime'])->name('appointment.time');
        Route::post('appointment/date-search/', [AppointmentController::class , 'FilterSearch'])->name('appointment.filter-search');
        Route::post('appointment/date-search-phone/', [AppointmentController::class , 'FilterSearchPhone'])->name('appointment.filter-search-phone');
        Route::get('appointment/create-data/{data}', [AppointmentController::class , 'createData'])->name('appointment.create-data');
        Route::resource('schedules', ScheduleController::class);
        Route::resource('doctors', DoctorController::class);
        Route::get('pusher-tester-view' , [HomeController::class , 'PusherView']);
        Route::get('pusher-tester-view2' , [HomeController::class , 'PusherView2']);
        Route::get('trash-can/appointment' , [AppointmentController::class , 'TrashCan'])->name('appointments.trash-can');
        Route::delete('restore-trash/appointment/{id}' , [AppointmentController::class , 'RestoreTrash'])->name('appointments.restore-trash');
        Route::delete('birthDayDoctor/destroy/{id}' , [NotificationController::class , 'destroy'])->name('birthDayDoctor.destroy');
        Route::get('birthDayDoctor/notifications' , [NotificationController::class , 'storeBirthdayDoctor'])->name('notifications.birthdayDoctor');




        Route::get('create-service/{id}' , [AppointmentController::class , 'getDoctor'])->name('get.doctor');
        Route::get('create-doctor-shift/{id}/{day}' , [AppointmentController::class , 'getShiftDoctor'])->name('get.shift.doctor');

        //carts
        Route::resource('carts', CartController::class);
        Route::get('/my-carts', [CartController::class, 'getCarts'])->name('carts.getCarts');
        Route::post('update-cart', [CartController::class, 'updateCart'])->name('carts.updateCart');
        Route::get('unset',[CartController::class, 'unsetCarts'])->name('carts.unset');
        Route::post('remove',[CartController::class, 'removeCart'])->name('carts.removeCart');

        Route::get('checkout',[OrderController::class, 'checkout'])->name('checkout.index');
        Route::post('vn-pay',[OrderController::class, 'vnpay'])->name('checkout.vnpay');
        Route::get('vn-pay-return',[OrderController::class, 'vnpayReturn'])->name('checkout.vnpay_return');
        Route::post('momo-pay',[OrderController::class, 'momoPay'])->name('checkout.momo');
        Route::post('cash',[OrderController::class, 'cash'])->name('checkout.cash');
        Route::get('purchase',[OrderController::class, 'index'])->name('purchase.index');
        Route::patch('purchase/{id}',[OrderController::class, 'update'])->name('purchase.update');
        Route::get('purchase/{id}',[OrderController::class, 'show'])->name('purchase.show');
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
