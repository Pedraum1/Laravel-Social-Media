<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public static function loginExists($email,$password){
        $possible_user = User::where('email',$email)->first();
        if(empty($possible_user)){
            return False;
        }
        if(!password_verify($password, $possible_user->password)){
            return False;
        }

        return True;
    }
}
