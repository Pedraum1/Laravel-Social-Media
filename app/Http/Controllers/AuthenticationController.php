<?php

namespace App\Http\Controllers;

use App\Classes\AuthClass;
use App\Classes\EncryptionClass;
use App\Models\UserModel;
use App\Models\RecoverModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        AuthClass::validateLogin($request);
        if(AuthClass::existsUserWithThisLogin($request)){
            $email = $request->input('emailInput');
            $password = $request->input('passwordInput');
            $user = UserModel::getLoginOrUser($email,$password,True);
            if(!$user){
                return redirect()->back()->withInput()->with(['validation_errors'=>True]);
            }
            session(['user'=>AuthClass::getUserInfos($user)]);
            return redirect()->route('home');
        }
        return redirect()->back()->withInput()->with(['validation_errors'=>True]);
    }

    public function register(Request $request){
        AuthClass::validateRegister($request);
        $user = AuthClass::createNewUser($request);
        AuthClass::sendValidationEmailTo($user);

        return redirect()->route('validation_sended')->with(['email_validation'=>$user->email]);
    }

    public function logout(){
        session()->forget('user');
        return redirect()->route('index');
    }

    public function validatingEmail($token){
        $user = AuthClass::validateUserEmail($token);
        if($user){
            session(['user'=>AuthClass::getUserInfos($user)]);
            return redirect()->route('home');
        }
        return abort(404);
        //TODO: ADD ERROR ON VALIDATING USER EMAIL RESPONSE
    }

    public function emailValidationPage(){
        $email = session('email_validation');
        return view('auth.emailValidation',['email'=>$email]);
    }

    public function sendResetEmail(Request $request){
        $request->validate(
            [
                'emailInput' => 'email|required'
            ],
            [
                'emailInput.email' => 'O Email inserido deve ser válido.',
                'emailInput.required' => 'Você precisa inserir um email.'
            ]
        );
        $email = $request->input('emailInput');
        $token = (Str::random(32));
        if(UserModel::getUserByEmail($email)){
            
            $new_recover = new RecoverModel;
            $new_recover->email = $email;
            $new_recover->token = $token;
            $new_recover->save();

            AuthClass::sendRecoverEmailTo($email,$token);

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

    public function resetPasswordSubmit(Request $request){
        $request->validate(
            [
                'idInput'=>'required',
                'passwordInput' => 'required|min:5|max:24|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'passwordInput_confirmation'=>'required|same:passwordInput'
            ],
            [
                'passwordInput.required' => 'A Senha é obrigatório',
                'passwordInput.min'      => 'A Senha deve ter no mínimo 5 caracteres',
                'passwordInput.max'      => 'A Senha deve ter no máximo 24 caracteres',
                'passwordInput.regex'    => 'A Senha deve ter pelo menos 1 letra maiúscula, 1 letra minúscula e 1 digito',

                'passwordInput_confirmation.required' => 'A Senha precisa ser confirmada',
                'passwordInput_confirmation.same'     => 'As senhas inseridas não batem'
            ]
        );
        $user = UserModel::getAliveUser()->find(EncryptionClass::decryptId($request->input('idInput')));
        $user->password = bcrypt($request->input('passwordInput')); 
        $user->save();

        return redirect()->route('login');
    }
}
