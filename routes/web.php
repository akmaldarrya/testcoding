<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('layout.dashboard');
});
Route::resource('customers', CustomerController::class);
Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');

Route::resource('contacts', ContactController::class);
Route::get('customers/{customerId}/contacts', [ContactController::class, 'indexForCustomer'])->name('contacts.indexForCustomer');

Route::resource('sales', SaleController::class);
Route::get('sales/report', [SaleController::class, 'report'])->name('sales.report');