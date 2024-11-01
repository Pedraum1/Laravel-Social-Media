<?php

namespace App\Http\Controllers;

use App\Classes\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Authentication extends Controller
{
    public function login(Request $request){
        Auth::validateLogin($request);
        if(Auth::existsUserWithThisLogin($request)){
            $email = $request->input('emailInput');
            $password = $request->input('passwordInput');
            $user = User::getLoginOrUser($email,$password,True);
            if(!$user){
                return redirect()->back()->withInput()->with(['validation_errors'=>True]);
            }
            session(['user'=>Auth::getUserInfos($user)]);
            return redirect()->route('home');
        }
        return redirect()->back()->withInput()->with(['validation_errors'=>True]);
    }

    public function register(Request $request){
        Auth::validateRegister($request);
        $user = Auth::createNewUser($request);
        Auth::sendValidationEmailTo($user);

        return redirect()->route('validation_sended')->with(['email_validation'=>$user->email]);
    }

    public function logout(){
        session()->forget('user');
        return redirect()->route('index');
    }

    public function validatingEmail($token){
        $user = Auth::validateUserEmail($token);
        if($user){
            session(['user'=>Auth::getUserInfos($user)]);
            return redirect()->route('home');
        }
        return abort(404);
        //TODO: ADD ERROR ON VALIDATING USER EMAIL RESPONSE
    }

    public function emailValidationPage(){
        $email = session('email_validation');
        return view('auth.emailValidation',['email'=>$email]);
    }
}
