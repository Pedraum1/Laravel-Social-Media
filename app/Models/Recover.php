<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recover extends Model
{
    protected $table = 'recovers';

    protected $fillable = ['email','token','expired_at'];

    public static function findRecoverByToken($token){
        return Recover::whereNull("expired_at")->where("token",$token)->first();
    }

    public function getToken($email){
        return $this->where('email',$email)->first()->token;
    }

    public function expire(){
        $this->update(["expired_at"=>Carbon::now()]);
    }

    public function user(): HasOne {
        return $this->hasOne(User::class,"email","email");
    }
}
