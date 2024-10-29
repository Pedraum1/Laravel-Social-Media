<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Http\Request;

class Auth {
  public static function validateLogin(Request $request){

    $request->validate([
          'emailInput'    => 'required|email',
          'passwordInput' => 'required',
      ],[
          'emailInput.required'    => 'Insira seu Email para realizar login',
          'emailInput.email'       => 'O Email inserido deve ser válido',
          'passwordInput.required' => 'Insira sua senha para realizar login',
      ]);
  }

  public static function validateRegister(Request $request){

    $request->validate([
          'emailInput'    => 'required|email',
          'passwordInput' => 'required',
      ],[
          'emailInput.required'    => 'Insira seu Email para realizar login',
          'emailInput.email'       => 'O Email inserido deve ser válido',
          'passwordInput.required' => 'Insira sua senha para realizar login',
      ]);

  }

  public static function existsUserWithThisLogin(Request $request){
    $email = $request->input('emailInput');
    $password = $request->input('passwordInput');

    if(User::loginExists($email,$password)){
      return True;
    }
    return False;
  }

}