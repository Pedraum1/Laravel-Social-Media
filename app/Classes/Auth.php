<?php

namespace App\Classes;

use App\Models\User;
use Carbon\Carbon;
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
          'nameInput'                  => 'required|min:6|max:30',
          'emailInput'                 => 'required|email|unique:users,email',
          'tagInput'                   => 'required|max:10|regex:/^[a-zA-Z0-9]+$/|unique:users,tag',
          'passwordInput'              => 'required|min:5|max:24|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
          'passwordInput_confirmation' => 'required|same:passwordInput'
      ],[
          'nameInput.required' => 'O nome de usuário é obrigatório',
          'nameInput.min'      => 'O nome deve ter no mínimo 6 caracteres',
          'nameInput.max'      => 'O nome deve ter no máximo 30 caracteres',

          'emailInput.required' => 'O Email é obrigatório',
          'emailInput.email'    => 'O Email deve ser válido',
          'emailInput.unique'   => 'O Email já foi cadastrado',

          'tagInput.required' => 'A Tag de usuário é obrigatória',
          'tagInput.max'      => 'A Tag deve ter no máximo 10 caracteres',
          'tagInput.regex'    => 'A Tag não pode ter caracteres especiais',
          'tagInput.unique'   => 'A Tag já foi cadastrada',

          'passwordInput.required' => 'A Senha é obrigatório',
          'passwordInput.min'      => 'A Senha deve ter no mínimo 5 caracteres',
          'passwordInput.max'      => 'A Senha deve ter no máximo 24 caracteres',
          'passwordInput.regex'    => 'A Senha deve ter pelo menos 1 letra maiúscula, 1 letra minúscula e 1 digito',

          'passwordInput_confirmation.required' => 'A Senha precisa ser confirmada',
          'passwordInput_confirmation.same'     => 'As senhas inseridas não batem'
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

  public static function createNewUser(Request $request){
    $user = new User();

    $user->email           = $request->input('emailInput');
    $user->password        = bcrypt($request->input('passwordInput'));
    $user->username        = $request->input('nameInput');
    $user->tag             = $request->input('tagInput');
    $user->followersNumber = 0;
    $user->followingNumber = 0;
    $user->Active          = 1;
    $user->profilePicture  = 'noProfile.webp';
    $user->lastLogin       = Carbon::now();
    $user->save();

    return $user;
  }

}