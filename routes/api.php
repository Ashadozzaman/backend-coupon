<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logoutApi']);
    Route::get('/course',[ApiController::class,'get_course'])->name('course');
    // Route::get('/checkout/{id?}',[ApiController::class,'checkout_course'])->name('checkout.course');
    Route::post('/checkout/submit',[ApiController::class,'checkout_submit'])->name('submit.checkout');
    Route::match(array('GET', 'POST'), 'checkout/{id?}', [ApiController::class,'checkout_course'])->name('checkout.course');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
