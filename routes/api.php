<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ServiceController;
use \App\Http\Controllers\Api\ReviewsController;
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
];
foreach ($objects as $key => $controller) {
    Route::apiResource($key, $controller);
}
Route::get('service-show', [ServiceController::class , 'showHome']);


