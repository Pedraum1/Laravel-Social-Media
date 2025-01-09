<?php

namespace App\Http\Controllers\Api;

use App\Classes\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Mail\RegisterEmailConfirmation;

use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->validated();

        $email = $credentials['emailInput'];
        $password = $credentials['passwordInput'];

        if(User::thisLoginExists($email, $password)){
            $user = User::getUserByEmail($email);

            if(!$user){
                return API::unauthorized();
            }
            
            return API::success($user->getApiInfos());;
        }
    }

    public function register(RegisterRequest $request){
        $credentials = $request->validated();
        $user = $this->createNewUser($credentials);
        $this->sendValidationEmailTo($user);

        return API::success([
            "email_for_validation" => $user->email
        ]);
    }

    private function createNewUser(array $credentials): User {
        
        $user = User::create($this->newUserInfos($credentials));

        #this generates the noProfile images of user
        $user->banner_image;
        $user->profile_image;

        session(['email_validation'=>$user->email]);

        return $user;
    }

    private function sendValidationEmailTo(User $user): void{
        $confirmation_link = route('validation',['token'=>$user->validation_token]);
        Mail::to($user->email)->send(new RegisterEmailConfirmation($user->username,$confirmation_link));
    }

    private function newUserInfos($credentials):array{
        return [
            "username"         => $credentials["nameInput"],
            "tag"              => $credentials["tagInput"],
            "email"            => $credentials["emailInput"],
            "password"         => bcrypt($credentials["passwordInput"]),
            "followersNumber"  => 0,
            "followingNumber"  => 0,
            "last_login"       => Carbon::now(),
            "validation_token" => Str::random(64)
        ];
    }
}
