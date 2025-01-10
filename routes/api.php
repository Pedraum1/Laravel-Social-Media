<?php

use App\Classes\API;
use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Support\Facades\Route;

Route::get('/status', function(){
    return API::success(["message"=>"API is running"]);
})->middleware('auth:sanctum');

Route::controller(AuthApiController::class)->group(function(){

    Route::post('/login','login');
    Route::post('/register','register');
    
    Route::patch('/validate/{token}','validateEmail')
         ->name('email_validation_with_api');
    
    Route::post('/require_password_reset','requirePasswordReset');
    Route::patch('/reset_password/{token}','resetPassword');

});

Route::post('/logout','logout')->middleware('auth:sanctum');
