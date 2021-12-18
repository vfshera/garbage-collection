<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PagesController ,
    ReportController,
     WasteController ,
      RedirectController ,
      AdminPagesController ,
       OrderController, QuestionController , UserPagesController};
use Illuminate\Support\Facades\Log;

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


Route::get('/', [PagesController::class , 'index'])->name('welcome');


Route::post('/question', [QuestionController::class , 'store'])->name('post-question');

Route::middleware(['auth:sanctum', 'verified'])->get('/auth/redirect', [RedirectController::class , 'findHome']);





Route::middleware(['auth:sanctum', 'verified'])->group(function(){


    




    //USER ROUTES
    Route::middleware(['user'])->prefix('/user')->name('user.')->group(function(){
        
        Route::get('/dashboard',[UserPagesController::class , 'dashboard'])->name('dashboard');

        Route::get('/location',[UserPagesController::class , 'location'])->name('location');

        Route::post('/update-location',[UserPagesController::class , 'locationUpdate'])->name('location-update');
        
        Route::get('/orders',[UserPagesController::class , 'orders'])->name('orders');

        Route::get('/billing',[UserPagesController::class , 'billing'])->name('billing');




        //Orders
        
        Route::prefix('/order')->name('order.')->group(function(){

            Route::get('/{order}/payment', [OrderController::class , 'payment'])->name('payment');

            Route::get('/{order}/payment-confirmation', [OrderController::class , 'confirm'])->name('pay-confirm');

            Route::get('/{order}/payment-check', [OrderController::class , 'checkPay'])->name('pay-check');

            Route::post('/pay/{order}', [OrderController::class , 'pay'])->name('pay');
        
            Route::post('/store', [OrderController::class , 'store'])->name('store');
        
            Route::put('/update', [OrderController::class , 'update'])->name('update');
        
            Route::delete('/delete/{order}', [OrderController::class , 'destroy'])->name('destroy');

                        
        });

        Route::prefix('/report')->name('report.')->group(function(){
            
            Route::get('/order', [UserPagesController::class , 'getOrderReport'])->name('order');
            
            Route::post('/order', [UserPagesController::class , 'getOrderReport'])->name('order-bound');

            // Route::get('/get-pdf' , [ReportController::class , 'generatePdf'])->name('pdf');
            
            Route::get('/payment', [UserPagesController::class , 'getPaymentReport'])->name('payment');
            
            Route::post('/payment', [UserPagesController::class , 'getPaymentReport'])->name('payment-bound');

        });

    });


    // ADMIN ROUTES
    Route::middleware(['admin'])->prefix('/admin')->name('admin.')->group(function(){

        Route::get('/dashboard', [AdminPagesController::class , 'dashboard'])->name('dashboard');

        Route::get('/users', [AdminPagesController::class , 'users'])->name('users');
        
        Route::get('/waste', [AdminPagesController::class , 'waste'])->name('waste');

        Route::get('/orders', [AdminPagesController::class , 'orders'])->name('orders');

        Route::get('/billing', [AdminPagesController::class , 'billing'])->name('billing');


        //WASTE
        Route::prefix('/waste')->name('waste.')->group(function(){

            Route::post('/store', [WasteController::class , 'store'])->name('store');
        
            Route::put('/update', [WasteController::class , 'update'])->name('update');
        
            Route::delete('/delete/{waste}', [WasteController::class , 'destroy'])->name('destroy');
            
        });


        Route::prefix('/report')->name('report.')->group(function(){
            
            Route::get('/order', [AdminPagesController::class , 'getOrderReport'])->name('order');
            
            Route::post('/order', [AdminPagesController::class , 'getOrderReport'])->name('order-bound');

            // Route::get('/get-pdf' , [ReportController::class , 'generatePdf'])->name('pdf');
            
            Route::get('/payment', [AdminPagesController::class , 'getPaymentReport'])->name('payment');
            
            Route::post('/payment', [AdminPagesController::class , 'getPaymentReport'])->name('payment-bound');

        });

    });

});