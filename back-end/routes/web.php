<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\admin\PermissionController;
use \App\Http\Controllers\admin\roleController;
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
            'service-categories' => \App\Http\Controllers\Admin\ServiceCategorieController::class,
            'service' => \App\Http\Controllers\Admin\ServiceController::class,
            'role' => roleController::class,
            'peopleAccount' => \App\Http\Controllers\admin\PeopleAccountController::class,
            'doctorAccount' => \App\Http\Controllers\admin\DoctorAccountController::class,
            'permission' => PermissionController::class,
            'product-categories' => \App\Http\Controllers\Admin\ProductCategoryController::class,
            'products' => \App\Http\Controllers\Admin\ProductController::class,
        ];
        foreach ($objects as $key => $controller) {
            Route::resource($key, $controller);
        }
        Route::get('dashboard', [HomeController::class , 'index'])->name('dashboard');
    });
});
Route::get('admin/login', [\App\Http\Controllers\authController::class , 'index'])->name('admin.login');
Route::get('admin/logout', [\App\Http\Controllers\authController::class , 'logOut'])->name('admin.logout');
Route::post('admin/login', [\App\Http\Controllers\authController::class , 'checkLogin'])->name('admin.login.post');

