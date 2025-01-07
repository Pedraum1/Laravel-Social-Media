<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserModel extends Model
{

    protected $table = 'users';

    public static function thisLoginExists($email, $password){
        if(UserModel::getLogin($email,$password)){
            return True;
        }
        return False;
    }

    private static function getLogin($email,$password){
        $possible_user = UserModel::where('deleted_at',null)->where('email',$email)->first();
        if(empty($possible_user)){
            return False;
        }

        if(!password_verify($password, $possible_user->password)){
            return False;
        }

        if($possible_user->email_verified_at != null){
            return $possible_user;
        }

        return False;
    }

    public static function getUserByEmail($email): bool|UserModel{
        return UserModel::getAliveUser()
                        ->where('email',$email)
                        ->first();
    }

    public static function getAliveUser(){
        return UserModel::where('deleted_at',null)->where('active',1)->whereNotNull('email_verified_at')->get();
    }

    public static function getUserByTag(string $tag){
        return UserModel::getAliveUser()->where('tag',$tag)->first();
    }

    public function profile_image(): HasOne {
        return $this->hasOne(ImageModel::class,'source_id','id')->where('deleted_at',null)->where('type','profile');
    }

    public function banner_image(): HasOne {
        return $this->hasOne(ImageModel::class,'source_id','id')->where('deleted_at',null)->where('type','banner');
    }

    public function posts(): HasMany{
        return $this->hasMany(PostModel::class,'user_id','id')->where('deleted_at',null)->where('type','post')->orderBy('created_at','desc');
    }
}
