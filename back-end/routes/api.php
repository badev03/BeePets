<?php

use App\Http\Controllers\Api\BookingController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ServiceController;
use \App\Http\Controllers\Api\ReviewsController;
use \App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\NewController;
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
];
foreach ($objects as $key => $controller) {
    Route::apiResource($key, $controller);
}
Route::get('service-show', [ServiceController::class , 'showHome']);
Route::get('service-filter', [ServiceController::class , 'filterService']);
Route::get('new-post', [NewController::class , 'postNew']);
Route::get('new-categories', [NewController::class , 'categoriesNew']);
Route::get('new-search/{name}', [NewController::class , 'searchNew']);
Route::get('new-home', [NewController::class , 'showNew']);

Route::post('/form', [BookingController::class, 'showForm']);
Route::post('/save', [BookingController::class, 'save']);
Route::post('/doctor/login', [DoctorController::class, 'login']);
