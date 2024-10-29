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
          'nameInput'     => 'required|min:6|max:30',
          'emailInput'    => 'required|email|unique:users,email',
          'tagInput'      => 'required|max:10|regex:/^[a-zA-Z0-9]+$/|unique:users,tag',
          'passwordInput' => 'required|min:5|max:24|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$',
          'passwordInput_confirmation'=>'required|same:passwordInput'
      ],[
        ''
      ]);

  }

  public static function getUserInfos(User $user){
    $user = [
      'id'              => Encryption::encryptId($user->id),
      'email'           => $user->email,
      'username'        => $user->username,
      'tag'             => $user->tag,
      'profile_picture' => $user->profilePicture
    ];
    return $user;
  }

  public static function existsUserWithThisLogin(Request $request){
    $email = $request->input('emailInput');
    $password = $request->input('passwordInput');

    if(User::getLoginOrUser($email,$password)){
      return True;
    }
    return False;
  }

}