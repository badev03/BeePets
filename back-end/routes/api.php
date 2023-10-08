<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Định nghĩa route cho phương thức showForm của ApiController
Route::post('/form', [BookingController::class, 'showForm']);

// Định nghĩa route cho phương thức save của ApiController
Route::post('/save', [BookingController::class, 'save']);
