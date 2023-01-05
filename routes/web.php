<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [LoginController::class, 'loginUser']);
Route::post('/', [LoginController::class, 'loginUserSubmit']);

Route::group(['middleware' => 'auth:customers'], function () {
   Route::get('products', [HomeController::class, 'products']);
   Route::post('product-category', [HomeController::class, 'productCategory']);
   Route::get('customer/logout',[LoginController::class,'customerLogout']);
});

Route::get('admin', [LoginController::class, 'login']);
Route::post('admin', [LoginController::class, 'loginSubmit']);

Route::group(['middleware' => 'auth'], function () {
   Route::prefix('users')->group(function () {
      Route::get('/', [UserController::class, 'users']);
      Route::get('/create', [UserController::class, 'userCreate']);
      Route::post('/create', [UserController::class, 'userStore']);
      Route::get('/edit/{id?}', [UserController::class, 'userEdit']);
      Route::post('/edit/{id?}', [UserController::class, 'userUpdate']);
      Route::post('/status-change', [UserController::class, 'statusChange']);
      Route::post('/delete/{id?}', [UserController::class, 'deleteUser']);
   });

   Route::prefix('category')->group(function () {
      Route::get('/', [CategoryController::class, 'category']);
      Route::get('/create', [CategoryController::class, 'categoryCreate']);
      Route::post('/create', [CategoryController::class, 'categoryStore']);
      Route::get('/edit/{id?}', [CategoryController::class, 'categoryEdit']);
      Route::post('/edit/{id?}', [CategoryController::class, 'categoryUpdate']);
      Route::post('/delete/{id?}', [CategoryController::class, 'deleteCategory']);
   });

   Route::prefix('product')->group(function () {
      Route::get('/', [ProductController::class, 'product']);
      Route::get('/create', [ProductController::class, 'productCreate']);
      Route::post('/create', [ProductController::class, 'productStore']);
      Route::get('/edit/{id?}', [ProductController::class, 'productEdit']);
      Route::post('/edit/{id?}', [ProductController::class, 'productUpdate']);
      Route::post('/delete/{id?}', [ProductController::class, 'deleteProduct']);
   });
   Route::get('admin/logout', [LoginController::class, 'adminLogout']);

});
