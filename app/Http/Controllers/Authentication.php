<?php

namespace App\Http\Controllers;

use App\Classes\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function login(Request $request){
        Auth::validateLogin($request);
        $email = $request->input('emailInput');
        $password = $request->input('passwordInput');
        if(Auth::existsUserWithThisLogin($request)){
            $user = User::getLoginOrUser($email,$password,True);
            session(['user'=>Auth::getUserInfos($user)]);
            return redirect()->route('home');
        }
        return redirect()->back()->withInput()->with(['validation_errors'=>True]);
    }

    public function register(Request $request){
        Auth::validateRegister($request);
        //TODO CRIAR SISTEMA DE REGISTRO
        return $request->all();
    }

    public function logout(){
        session()->destroy();
        return redirect()->route('index');
    }
}
