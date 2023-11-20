<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\ProductController;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('products', ProductController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("get_all_invoices", [InvoiceController::class, 'index']);
Route::get("create_invoice", [InvoiceController::class, 'create']);
Route::get("customers", [CustomerController::class, 'index']);
Route::get("products", [ProductController::class, 'index']);
Route::post("products/store", [ProductController::class, 'store']);