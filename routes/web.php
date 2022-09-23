<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/course',[HomeController::class,'get_course'])->name('course');
Route::get('/checkout/{id?}',[HomeController::class,'checkout_course'])->name('checkout.course');
Route::post('/checkout/submit',[HomeController::class,'checkout_submit'])->name('submit.checkout');
Route::match(array('GET', 'POST'), 'checkout/{id?}', [HomeController::class,'checkout_course'])->name('checkout.course');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
