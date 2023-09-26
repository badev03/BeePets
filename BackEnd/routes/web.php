<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;

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
Route::prefix('admin')->group(function () {
    $objects = [
        'service-categories' => \App\Http\Controllers\Admin\ServiceCategorieController::class,
    ];
    foreach ($objects as $key => $controller) {
     Route::resource($key, $controller);


}

});


