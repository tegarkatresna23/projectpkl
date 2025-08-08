<?php

use Illuminate\Support\Facades\Route;

//import product controller
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;

//route resource for products
Route::resource('/suppliers', SupplierController::class);
Route::resource('/purchases', PurchaseController::class);
Route::resource('/users', UserController::class);

Route::get('/', function () {
    return view('welcome');
});