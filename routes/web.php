<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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

Route::get('register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'store'])->name('register');



Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('forget-password', [ForgotPasswordController::class, 'getEmail']);
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail']);
Route::post('/update-pass/{id}', [ForgotPasswordController::class, 'update'])->name('update.pass');


Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'Auth\ResetPasswordController@updatePassword');

Route::group(['prefix' => '', 'middleware' => 'checklogin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryProductsController::class, 'index'])->name('category');
        Route::get('/create', [CategoryProductsController::class, 'show'])->name('category.show');
        Route::post('/add', [CategoryProductsController::class, 'store'])->name('category.add');
        Route::get('/edit/{id}/', [CategoryProductsController::class, 'edit'])->name('category.edit');
        Route::post('/edit/{id}/', [CategoryProductsController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryProductsController::class, 'destroy'])->name('category.delete');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductsController::class, 'index'])->name('product');
        Route::get('/list', [ProductsController::class, 'show'])->name('product.list');
        Route::get('/delete/{id}', [ProductsController::class, 'destroy'])->name('product.delete');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
        Route::post('/{id}/edit', [ProductsController::class, 'update'])->name('product.update');
        Route::post('/add', [ProductsController::class, 'store'])->name('product.add');
    });
});
