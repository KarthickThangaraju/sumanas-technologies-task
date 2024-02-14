<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeController;
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

//Route::post('/payment', [StripeController::class, 'payment']);

Auth::routes();

Route::middleware("auth")->group(function () {
    Route::get('/product', [ProductController::class, 'view'])->name("product.view");;
    Route::get('/payment/{id}', [ProductController::class, 'payment']);
    Route::post('create', [ProductController::class, 'subscription'])->name("subscription.create");
    //Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
