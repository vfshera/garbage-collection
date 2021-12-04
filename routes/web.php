<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\{PagesController , RedirectController ,AdminPagesController , OrderController, UserPagesController};

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

Route::middleware(['auth:sanctum', 'verified'])->get('/auth/redirect', [RedirectController::class , 'findHome']);





//USER ROUTES
Route::middleware(['auth:sanctum', 'verified', 'user'])->prefix('/user')->name('user.')->group(function(){
    
    Route::get('/dashboard',[UserPagesController::class , 'dashboard'])->name('dashboard');
    Route::get('/location',[UserPagesController::class , 'location'])->name('location');
    
    Route::get('/orders',[UserPagesController::class , 'orders'])->name('orders');

    Route::get('/billing',[UserPagesController::class , 'billing'])->name('billing');



    //Orders
    
    Route::prefix('/order')->name('order.')->group(function(){

        Route::get('/{order}/payment', [OrderController::class , 'payment'])->name('payment');

        Route::post('/pay/{order}', [OrderController::class , 'pay'])->name('pay');
    
        Route::post('/store', [OrderController::class , 'store'])->name('store');
    
        Route::put('/update', [OrderController::class , 'update'])->name('update');
    
        Route::delete('/delete/{order}', [OrderController::class , 'destroy'])->name('destroy');
        
    });

    

});








// ADMIN ROUTES
Route::middleware(['auth:sanctum', 'verified','admin'])->prefix('/admin')->name('admin.')->group(function(){

    Route::get('/dashboard', [AdminPagesController::class , 'dashboard'])->name('dashboard');

    Route::get('/users', [AdminPagesController::class , 'users'])->name('users');
    
    Route::get('/waste', [AdminPagesController::class , 'waste'])->name('waste');

    Route::get('/orders', [AdminPagesController::class , 'orders'])->name('orders');


    //WASTE
    Route::prefix('/waste')->name('waste.')->group(function(){

        Route::post('/store', [WasteController::class , 'store'])->name('store');
    
        Route::put('/update', [WasteController::class , 'update'])->name('update');
    
        Route::delete('/delete/{waste}', [WasteController::class , 'destroy'])->name('destroy');
        
    });

});