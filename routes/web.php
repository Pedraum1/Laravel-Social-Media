<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HasEmailToValidate;
use App\Http\Middleware\NotVerified;
use App\Http\Middleware\Verified;
use Illuminate\Support\Facades\Route;

//Authenticated user routes
Route::middleware(Verified::class)->group(function(){
    Route::get('/home',[MainController::class,'home'])->name('home');
    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');

    Route::prefix('profile')->group(function(){
        Route::get('{tag}',[ProfileController::class,'profile'])->name('profile');
        Route::post('update',[ProfileController::class,'updateProfile'])->name('profileUpdate');
    });

    Route::prefix('/post')->group(function(){
        Route::get('{id}',[MainController::class,'post'])->name('seePost');
        Route::get('/delete/{id}',[MainController::class,'deletePost'])->name('deletePost');
    });
});

//Not authenticated user routes
Route::middleware(NotVerified::class)->group(function(){

    Route::view('/','index')->name('index');

    Route::view('/login','auth.login')->name('login');
    Route::post('/login_submit',[AuthenticationController::class,'login'])->name('login_submit');

    Route::view('/register','auth.register')->name('register');
    Route::post('/register_submit',[AuthenticationController::class,'register'])->name('register_submit');
    
    Route::get('/validation',[AuthenticationController::class,'emailValidationPage'])->middleware(HasEmailToValidate::class)->name('validation_sended');
    Route::get('/validation/{token}',[AuthenticationController::class,'validatingEmail'])->name('validation');

    Route::view('/recover','auth.SendResetLink')->name('sendEmailToRecover');
    Route::post('/recover_submit',[AuthenticationController::class,'sendResetEmail'])->name('sendResetEmail');
    Route::get('/recover_password/{token}',[AuthenticationController::class,'recoverPassword'])->name('recoverPassword');
    Route::post('/recovered_password/{token}',[AuthenticationController::class,'recoveredPassword'])->name('recoveredPassword');
    Route::get('/reset_password/{id}',[AuthenticationController::class,'resetPassword'])->name('resetPassword');
    Route::post('/reset_password',[AuthenticationController::class,'resetPasswordSubmit'])->name('resetPasswordSubmit');
});
