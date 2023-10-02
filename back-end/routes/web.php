<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use \App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
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
        ];
        foreach ($objects as $key => $controller) {
            Route::resource($key, $controller);
        }
        Route::get('dashboard', [HomeController::class , 'index'])->name('dashboard');
    });
});
Route::get('admin/login', [\App\Http\Controllers\AuthController::class , 'index'])->name('admin.login');
Route::get('admin/logout', [\App\Http\Controllers\AuthController::class , 'logOut'])->name('admin.logout');
Route::post('admin/login', [\App\Http\Controllers\AuthController::class , 'checkLogin'])->name('admin.login.post');

