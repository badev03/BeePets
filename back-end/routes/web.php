<?php

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
Route::middleware(['role:Admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        $objects = [
            'service-categories' => ServiceCategorieController::class,
            'service' => ServiceController::class,
            'role' => RoleController::class,
            'people-account' => PeopleAccountController::class,
            'doctors' => DoctorController::class,
            'permission' => PermissionController::class,
            'product-categories' => ProductCategoryController::class,
            'products' => ProductController::class,
            'type-pet' => TypePetController::class
            
        ];
        foreach ($objects as $key => $controller) {
            Route::resource($key, $controller);
        }
        Route::get('dashboard', [HomeController::class , 'index'])->name('dashboard');
        Route::resource('schedules', ScheduleController::class);

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

