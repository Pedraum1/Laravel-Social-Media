<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecoverModel extends Model
{
    protected $table = 'recovers';

    public function getToken($email){
        return $this->where('email',$email)->first()->token;
    }
}
