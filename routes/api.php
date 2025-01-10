<?php

use App\Classes\API;
use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/status', function(){
    return API::success(["message"=>"API is running"]);
});

Route::post('/login',[AuthApiController::class,'login']);
Route::post('/register',[AuthApiController::class,'register']);
Route::post('/logout',[AuthApiController::class,'logout']);
Route::patch('/validate/{token}',[AuthApiController::class,'validateEmail'])
     ->name('email_validation_with_api');

Route::post('/require_password_reset',[AuthApiController::class,'requirePasswordReset']);
Route::patch('/reset_password/{token}',[AuthApiController::class,'resetPassword']);