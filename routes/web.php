<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Main;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HasEmailToValidate;
use App\Http\Middleware\NotVerified;
use App\Http\Middleware\Verified;
use Illuminate\Support\Facades\Route;

//Authenticated user routes
Route::middleware(Verified::class)->group(function(){
    Route::get('/home',[Main::class,'home'])->name('home');
    Route::get('/logout',[Authentication::class,'logout'])->name('logout');

    Route::get('/profile/{tag}',[ProfileController::class,'profile'])->name('profile');
});

//Not authenticated user routes
Route::middleware(NotVerified::class)->group(function(){
    Route::view('/','index')->name('index');
    Route::view('/login','auth.login')->name('login');
    Route::post('/login_submit',[Authentication::class,'login'])->name('login_submit');
    Route::view('/register','auth.register')->name('register');
    Route::post('/register_submit',[Authentication::class,'register'])->name('register_submit');
    Route::get('/validation',[Authentication::class,'emailValidationPage'])->middleware(HasEmailToValidate::class)->name('validation_sended');
    Route::get('/validation/{token}',[Authentication::class,'validatingEmail'])->name('validation');
});
