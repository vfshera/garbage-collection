<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/validation' , [MpesaController::class , 'validation']);

Route::post('/confirmation', [ MpesaController::class , 'confirmation']);

Route::post('/stkpush', [  MpesaController::class , 'stkpushCallback']);




Route::prefix('/b2c')->group( function(){

    Route::post('/callback', [ MpesaController::class , 'b2cCallback']);

    Route::post('/queue', [MpesaController::class , 'b2cTimeOut']);

});


Route::prefix('/ac-balance')->group( function(){

    Route::post('/callback', [ MpesaController::class , 'balanceCallback']);

    Route::post('/queue', [MpesaController::class , 'balanceTimeOut']);

});


Route::prefix('/transaction')->group( function(){

    Route::post('/callback', [ MpesaController::class , 'transactionCallback']);

    Route::post('/queue', [MpesaController::class , 'transactionTimeOut']);

});


Route::prefix('/reverse')->group( function(){

    Route::post('/callback', [ MpesaController::class , 'reverseCallback']);

    Route::post('/queue', [MpesaController::class , 'reverseTimeOut']);

});