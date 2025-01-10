<?php

namespace App\Http\Controllers\Api;

use App\Classes\API;
use App\Classes\EncryptionClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\RegisterEmailConfirmation;
use App\Mail\reset_password;
use App\Models\Recover;
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

        if($this->isLoginValid($email,$password)){
            $user = User::getUserByEmail($email);
            return API::success($user->getApiInfos());
        }

        return API::unauthorized();
    }

    public function logout(LogoutRequest $credentials){
        $user_id = $credentials['userIdInput'];
        $user = User::find(EncryptionClass::decryptId($user_id));
        $user->tokens()->delete();

        return API::success(["message"=>"Logout successfull"]);
        
    }

    public function register(RegisterRequest $request){
        $credentials = $request->validated();
        $user = $this->createNewUser($credentials);
        $this->sendValidationEmailTo($user);

        return API::success([
            "email_for_validation" => $user->email
        ]);
    }

    public function validateEmail($token){
        $user = User::getNonValidatedUser($token);
        if($user){
            $user->update(["email_verified_at"=>Carbon::now()]);
            return API::success($user->getApiInfos());
        }
        return API::failed("This token has expired");
    }

    public function requirePasswordReset(ResetEmailRequest $request){
        $credentials = $request->validated();
        $email = $credentials['emailInput'];

        if(User::getUserByEmail($email)){
            $token = Encryption::encrypt($this->generateRecoverToken($email));
            $this->sendRecoverEmailTo($email,$token);

            return API::success(['email_for_recover'=>$email]);
        }

        return API::failed("This user wasn't finded");

    }
    
    public function resetPassword(ResetPasswordRequest $request, $token){
        $recover = Recover::findRecoverByToken(Encryption::decrypt($token));

        if(!$recover){
            return API::failed("This reset request has expired long ago");
        }
        
        $credentials = $request->validated();
        $password = $credentials['passwordInput'];
        $user = $recover->user;        

        if($user->exists()){
            $user->updatePassword($password);
            $recover->expire();
            
            return API::success(["Message"=>"Password updated successfully"]);
        }

        return API::failed("This user wasn't finded");
    }

    private function isLoginValid($email,$password): bool {

        if(User::thisLoginExists($email, $password)){
            $user = User::getUserByEmail($email);

            if(!$user){
                return false;
            }
            
            return true;
        }
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
        $confirmation_link = route('validation_with_api',['token'=>$user->validation_token]);
        $confirmation_link = route('email_validation_with_api',['token'=>$token]);
        Mail::to($user->email)
            ->send(new RegisterEmailConfirmation($user->username,$confirmation_link));
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

    private function generateRecoverToken(string $email): string {
        $token = $this->generateToken();
        Recover::create([
            "email"=>$email,
            "token"=>$token
        ]);

        return $token;
    }

    private function sendRecoverEmailTo(string $email ,string $token){
        $reset_link = "http://route_for_reseting_password/" . $token; //TODO: SUBSTITUTE WITH IVOR LINK
        Mail::to($email)->send(new reset_password($reset_link));
    }

    private function generateToken(){
        return Str::random(32);
    }
}
