<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
  
  protected $table = 'images';

  protected $fillable = ["source_id","type","name"];

  public static function generateNoProfileImage($user_id,$type){
    $image = new Image();

    $image->source_id = $user_id;
    $image->type = $type;
    $image->name = "noProfile.webp";
    $image->created_at = Carbon::now();
    
    $image->save();
  }
  
}