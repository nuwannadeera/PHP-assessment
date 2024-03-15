<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//--------------------------------------login register routes

Route::post('/registration', [AuthUserController::class, 'registrationPost'])->name('registrationPost');

Route::post('/login', [AuthUserController::class, 'loginPost'])->name('loginPost');


//--------------------------------------customer routes

Route::post('/addCustomer', [CustomerController::class, 'addCustomer'])
    ->name('addCustomer');

Route::get('/viewCustomer', [CustomerController::class, 'viewCustomer'])
    ->name('viewCustomer');

Route::patch('updateCustomerDetail/{id}',[CustomerController::class, 'updateCustomerDetail'])
    ->name('updateCustomerDetail');

Route::delete('deleteCustomer/{id}',[CustomerController::class, 'deleteCustomer'])
    ->name('deleteCustomer');


