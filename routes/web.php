<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/orders', [OrdersController::class, 'loadAll'])->name('orders');

Route::get('/orders/new', function () {
    return view('orderNew');
})->name('orderNew');

Route::get('/orders/search', [OrdersController::class, 'search'])->name('search');

Route::get('/orders/details/{id}', [OrdersController::class, 'loadOne'])->name('order-data-one');

Route::get('/orders/details/{id}/delete', [OrdersController::class, 'deleteOne'])->name('order-delete');


Route::get('/product', function () {
    return view('product');
})->name('product');


Route::post('/orders/create', [OrdersController::class, 'create'])->name('orderCreate');

Route::get('/payments', function () {
    return view('payments');
})->name('payments');

Route::get('/setings', function () {
    return view('setings');
})->name('setings');

*/

Route::get('/auth', [AuthController::class, 'getAuth'])->middleware('guest')->name('auth');
Route::post('/auth', [AuthController::class, 'postAuth'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/user', function (Request $req){
	return Auth::user();
});

Route::fallback(function(){
	return view('layouts/app');
})->middleware('auth');