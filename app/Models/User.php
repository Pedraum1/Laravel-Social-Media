<?php

namespace App\Models;

use App\Classes\Encryption;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{

    use HasApiTokens;

    protected $table = 'users';

    protected $fillable = ["username", "email", "password", "description",
                           "followersNumber", "followingNumber", "postsNumber",
                           "active", "tag", "last_login","email_verified_at",
                           "validation_token"];

    public static function thisLoginExists($email, $password){
        if(User::getLogin($email,$password)){
            return True;
        }
        return False;
    }

    private static function getLogin($email,$password){
        $possible_user = User::where('deleted_at',null)->where('email',$email)->first();
        if(empty($possible_user)){
            return False;
        }

        if(!password_verify($password, $possible_user->password)){
            return False;
        }

        if($possible_user->email_verified_at == null){
            return False;
        }

        return $possible_user;
    }
    
    public static function getAliveUser(){
        return User::where('deleted_at',null)->where('active',1)->whereNotNull('email_verified_at')->get();
    }
    
    public static function getNonValidatedUser($token){
        return User::where('deleted_at',null)
        ->where('email_verified_at',null)
        ->where('validation_token',$token)
        ->first();
    }

    public static function getUserByEmail($email): bool|User{
        return User::getAliveUser()
                        ->where('email',$email)
                        ->first();
    }

    public static function getUserByTag(string $tag){
        return User::getAliveUser()->where('tag',$tag)->first();
    }

    public function getInfos():array {
        return [
            'user_id'     => Encryption::encrypt($this->id),
            'email'       => $this->email,
            'username'    => $this->username,
            'tag'         => $this->tag,
            'profile_img' => $this->profile_image->name
          ];
    }

    public function getApiInfos(): array {
        return[
            'user_id'     => Encryption::encrypt($this->id),
            "email"       => $this->email,
            "username"    => $this->username,
            "tag"         => $this->tag,
            "profile_img" => $this->profile_image->name,
            "token"       => $this->createToken($this->username)->plainTextToken
        ];
    }

    public function updatePassword($new_password):void {
        $this->update(["password"=>bcrypt($new_password)]);
    }

    //FEATURES FUNCTIONS

    public function profile_image(): HasOne {
        $image = $this->hasOne(Image::class,'source_id','id')
                      ->where('deleted_at',null)
                      ->where('type','profile');
                      
        if($image->exists()){
            return $image;
        }
        Image::generateNoProfileImage($this->id,"profile");

        return $this->profile_image();
    }

    public function banner_image(): HasOne {
        $image = $this->hasOne(Image::class,'source_id','id')
                      ->where('deleted_at',null)
                      ->where('type','banner');

        if($image->exists()){
            return $image;
        }
        Image::generateNoProfileImage($this->id,"banner");

        return $this->banner_image();
    }

    public function posts(): HasMany{
        return $this->hasMany(Post::class,'user_id','id')
                    ->where('deleted_at',null)
                    ->where('type','post')
                    ->orderBy('created_at','desc');
    }
}
