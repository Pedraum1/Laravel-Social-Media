<?php

namespace App\Http\Controllers;

use App\Classes\EncryptionClass;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetEmailRequest;
use App\Http\Requests\ResetPasswordRequest;

use App\Mail\RegisterEmailConfirmation;
use App\Mail\reset_password;
use App\Models\UserModel;
use App\Models\RecoverModel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{

    public function login(LoginRequest $request){

        $credentials = $request->validated();
        $email = $credentials['emailInput'];
        $password = $credentials['passwordInput'];

        if(UserModel::thisLoginExists($email, $password)){
            $user = UserModel::getUserByEmail($email);

            if(!$user){
                return redirect()->back()
                                 ->withInput()
                                 ->with(['validation_errors'=>True]);
            }

            session(['user'=>$user->getInfos()]);
            return redirect()->route('home');
        }
        
        return redirect()->back()->withInput()->with(['validation_errors'=>True]);
    }

    public function register(RegisterRequest $request){
        $credentials = $request->validated();

        $user = $this->createNewUser($credentials);
        $this->sendValidationEmailTo($user);

        return redirect()->route('validation_sended')->with(['email_validation'=>$user->email]);
    }

    public function logout(){
        session()->forget('user');
        return redirect()->route('index');
    }

    public function validatingEmail($token){
        $user = $this->validateUserEmail($token);
        if($user){
            $user_infos = $user->getInfos();
            session(['user'=>$user_infos]);
            return redirect()->route('home');
        }
        return abort(404);
        //TODO: ADD ERROR ON VALIDATING USER EMAIL RESPONSE
    }

    public function emailValidationPage(){
        $email = session('email_validation');
        return view('auth.emailValidation',['email'=>$email]);
    }

    public function sendResetEmail(ResetEmailRequest $request){
        $credentials = $request->validated();
        $email = $credentials['emailInput'];
        $token = (Str::random(32));

        if(UserModel::getUserByEmail($email)){            
            $new_recover = RecoverModel::create([
                "email"=>$email,
                "token"=>$token
            ]);
            $this->sendRecoverEmailTo($new_recover->email,$new_recover->token);

            return redirect()->back()->withInput()->with(['recover_success'=>True]);
        }
        return redirect()->back()->withInput()->with(['recover_error'=>True]);
    }

    public function recoverPassword($token){
        $recover = RecoverModel::where('token',$token)->where('expired_at',null)->first();
        $user = UserModel::getAliveUser()->where('email',$recover->email)->first();

        if($recover)
        {
            $recover->expired_at = Carbon::now();
            $recover->save();
            return redirect()->route('resetPassword',['id'=>EncryptionClass::encryptId($user->id)]);            
        }
        return abort(404);
    }

    public function resetPassword($id){
        return view('auth.resetPassword',['id'=>$id]);
    }

    public function resetPasswordSubmit(ResetPasswordRequest $request){
        $credentials = $request->validated();
        $id = $credentials['idInput'];
        $password = $credentials['passwordInput'];

        $user = UserModel::getAliveUser()->find(EncryptionClass::decryptId($id));
        $user->updatePassword($password);

        return redirect()->route('login');
    }

    private function createNewUser(array $credentials): UserModel{
        
        $user = UserModel::create($this->newUserInfos($credentials));

        #this generates the noProfile images of user
        $user->banner_image;
        $user->profile_image;

        session(['email_validation'=>$user->email]);

        return $user;
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

    private function sendValidationEmailTo(UserModel $user): void{
        $confirmation_link = route('validation',['token'=>$user->validation_token]);
        Mail::to($user->email)->send(new RegisterEmailConfirmation($user->username,$confirmation_link));
    }

    private function validateUserEmail($token){
        $user = UserModel::getNonValidatedUser($token);
        if($user){
            $user->update(["email_verified_at"=>Carbon::now()]);
            return $user;
        }
        return False;
    }

    private function sendRecoverEmailTo($email,$token){
        $reset_link = route('recoverPassword',['token'=>$token]);
        Mail::to($email)->send(new reset_password($reset_link));
      }
}
