<?php

use Illuminate\Support\Facades\Route;

//import product controller
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockLogController;


//route resource for products
Route::resource('/suppliers', SupplierController::class);
Route::resource('/purchases', PurchaseController::class);
Route::resource('/users', UserController::class);
Route::resource('/categories', CategorieController::class);
Route::resource('/products', ProductController::class);
Route::resource('/sales', SaleController::class);
Route::resource('stock_logs', StockLogController::class);


Route::get('/', function () {
    return view('welcome');
});