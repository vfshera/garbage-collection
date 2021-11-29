<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RedirectController;

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
    
    Route::get('/dashboard', function () {
        
        return view('dashboard');
    })->name('dashboard');


});




// ADMIN ROUTES
Route::middleware(['auth:sanctum', 'verified','admin'])->prefix('/admin')->name('admin.')->group(function(){

    Route::get('/dashboard', function () {
        
        return view('dashboard');

    })->name('dashboard');

});