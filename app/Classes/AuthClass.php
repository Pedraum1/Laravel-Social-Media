<?php

namespace App\Classes;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterEmailConfirmation;
use App\Mail\reset_password;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthClass {

  public static function getUserInfos(UserModel $user){
    return [
      'id'              => EncryptionClass::encryptId($user->id),
      'email'           => $user->email,
      'username'        => $user->username,
      'tag'             => $user->tag,
      'profile_img' =>     ProfileClass::profileImage($user)
    ];
  }

  public static function createNewUser(Request $request){
    $user = new UserModel();

    $user->email           = $request->input('emailInput');
    $user->password        = bcrypt($request->input('passwordInput'));
    $user->username        = $request->input('nameInput');
    $user->tag             = $request->input('tagInput');
    $user->followersNumber = 0;
    $user->followingNumber = 0;
    $user->last_login       = Carbon::now();
    $user->validation_token= Str::random(64);
    $user->save();

    session(['email_validation'=>$user->email]);

    return $user;
  }

  public static function sendValidationEmailTo(UserModel $user){
    $confirmation_link = route('validation',['token'=>$user->validation_token]);
    Mail::to($user->email)->send(new RegisterEmailConfirmation($user->username,$confirmation_link));
  }

  public static function validateUserEmail($token){
    $user = UserModel::where('deleted_at',null)->where('email_verified_at',null)->where('validation_token',$token)->first();
    if($user){
      $user->email_verified_at = Carbon::now();
      $user->save();
      return $user;
    }
    return False;
  }

  public static function sendRecoverEmailTo($email,$token){
    $reset_link = route('recoverPassword',['token'=>$token]);
    Mail::to($email)->send(new reset_password($reset_link));
  }

}