<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;
use Dompdf\Dompdf;


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


Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [PaymentController::class, 'today'])->name('dashboard');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/update/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/update/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    
    Route::get('/payments/new/{payment}', [PaymentController::class, 'new'])->name('payments.new');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/edit/{payment}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/update/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/delete/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::post('/customers', [CustomerController::class, 'find'])->name('customers.find');
    Route::post('/customers/findname', [CustomerController::class, 'findname'])->name('customers.findname');
    Route::post('/customers/downloadpdf', [CustomerController::class, 'downloadpdf'])->name('customers.downloadpdf');

    Route::post('/payments', [PaymentController::class, 'find'])->name('payments.find');
    Route::post('/payments/downloadpdf', [PaymentController::class, 'downloadpdf'])->name('payments.downloadpdf');


});

// Route::resource('customers', CustomerController::class);
// Route::resource('payments', PaymentController::class);


require __DIR__.'/auth.php';

