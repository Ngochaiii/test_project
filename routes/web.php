<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryProductsController;
use App\Http\Controllers\CustommerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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
    Route::group(['middleware' => ['moduleProduct']], function () {
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
    Route::group(['middleware' => ['moduleCustomer']], function () {
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', [CustommerController::class, 'index'])->name('customers');
            route::get('/create', [CustommerController::class, 'create'])->name('customers.create');
            route::post('/create', [CustommerController::class, 'store'])->name('customers.store');
            Route::get('/{key}/edit', [CustommerController::class, 'edit'])->name('customers.edit');
            Route::get('/{key}/change', [CustommerController::class, 'change'])->name('customers.change');
            Route::get('/{key}/cancel', [CustommerController::class, 'cancel'])->name('customers.cancel');
            Route::get('/{key}/show', [CustommerController::class, 'show'])->name('customers.show');
            Route::post('/{key}/edit', [CustommerController::class, 'update'])->name('customers.update');
            Route::post('/{key}/delete', [CustommerController::class, 'delete'])->name('customers.delete');
        });
    });
    Route::group(['middleware' => ['admin']], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::post('/change/{id}', [UserController::class, 'change'])->name('grant_benefits');
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete_grant_benefits');
            Route::get('/mail', [TaskController::class, 'index'])->name('index');
            Route::post('/task', [TaskController::class, 'store'])->name('store.task');
            Route::delete('/task/{id}', [TaskController::class, 'delete'])->name('delete.task');
        });
    });
});
