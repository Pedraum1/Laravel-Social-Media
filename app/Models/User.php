<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{        
    /**
     * use the parameter $option as False|Null or True to change between
     * returning if login exists or returning a user object respectively.
     *
     * @param  string $email
     * @param  string $password
     * @param  bool $option
     * @return true|false|User
     */
    public static function getLoginOrUser($email,$password,$option=False){
        $possible_user = User::where('deleted_at',null)->where('email',$email)->first();
        if(empty($possible_user)){
            return False;
        }
        if(!password_verify($password, $possible_user->password)){
            return False;
        }
        if($option == True){
            if($possible_user->email_verified_at != null){
                return $possible_user;
            }
            return False;
        }
        return True;
    }

    public static function getAliveUser(){
        return User::where('deleted_at',null)->where('active',1)->whereNotNull('email_verified_at')->get();
    }

    public static function getUserByTag(string $tag){
        return User::getAliveUser()->where('tag',$tag)->first();
    }

    public function profile_image(): HasOne {
        return $this->hasOne(Image::class,'source_id','id')->where('deleted_at',null)->where('type','profile');
    }

    public function banner_image(): HasOne {
        return $this->hasOne(Image::class,'source_id','id')->where('deleted_at',null)->where('type','banner');
    }
}
