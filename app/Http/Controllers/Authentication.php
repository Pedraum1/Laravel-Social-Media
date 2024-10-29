<?php

namespace App\Http\Controllers;

use App\Classes\Auth;
use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function login(Request $request){
        Auth::validateLogin($request);
        if(Auth::existsUserWithThisLogin($request)){
            return True;//redirect()->to('homepage');
        }
        return redirect()->back()->withInput()->with(['validation_errors'=>True]);
    }
}
