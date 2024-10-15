<?php

use App\Http\Controllers\Main;
use App\Http\Middleware\NotVerified;
use App\Http\Middleware\Verified;
use Illuminate\Support\Facades\Route;

//Not authenticated routes
Route::middleware(Verified::class)->group(function(){
    Route::get('/home',[Main::class,'home'])->name('home');
});

//Authenticated routes
Route::middleware(NotVerified::class)->group(function(){
    Route::view('/','index')->name('index');
});
