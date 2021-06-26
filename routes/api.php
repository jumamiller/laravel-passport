<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\passportAuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[passportAuthController::class,'registerUserExample']);
Route::post('login',[passportAuthController::class,'loginUserExample']);
Route::middleware('auth:api')->group(function(){
    Route::get('user', [passportAuthController::class,'authenticatedUserDetails']);
});
