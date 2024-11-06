<?php

namespace App\Classes;

use App\Models\ImageModel;
use App\Models\UserModel;
use App\Rules\ProfileNameLength;
use App\Rules\BannerNameLength;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileClass{

  public static function profileImage(UserModel $user): string{
    if($user->profile_image != null){
      return $user->profile_image->name;
    }
    return 'noProfile.webp';
  }

  public static function bannerImage(UserModel $user): string{
    if($user->banner_image != null){
      return $user->banner_image->name;
    }
    return 'noProfile.webp';
  }

  public static function organizeProfileData(UserModel $user){

    $profile_image = ProfileClass::profileImage($user);
    $banner_image = ProfileClass::bannerImage($user);
        return [
          'username'=>$user->username,
          'description'=>$user->description,
          'tag'=>$user->tag,
          'followers_num'=>$user->followersNumber,
          'following_num'=>$user->followingNumber,
          'posts_num'=>$user->postsNumber,
          'profile_img'=>$profile_image,
          'banner_img'=>$banner_image,
          'posts'=>$user->posts
        ];
  }

  public static function validateLoginUpdate(Request $request){
    $request->validate([
      'nameInput'        => 'required|min:6|max:30',
      'profileInput'     => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048', new ProfileNameLength(60)],
      'bannerInput'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096', new BannerNameLength(60)]
    ],[
      'nameInput.required' => 'O Campo de nome precisa estar preenchido',
      'nameInput.min'      => 'O Nome deve ter mais que 6 caracteres',
      'nameInput.max'      => 'O Nome deve ter menos que 6 caracteres',
      'profileInput.image' => 'O arquivo da foto de perfil deve ser uma imagem',
      'profileInput.mimes' => 'O arquivo da deve estar no formato PNG, JPG, JPEG ou WEBP',
      'profileInput.max'   => 'O Arquivo enviado da foto de perfil é muito grande (Max: 2Mb)',
      'bannerInput.image'  => 'O arquivo do banner de perfil deve ser uma imagem',
      'bannerInput.mimes'  => 'O arquivo da deve estar no formato PNG, JPG, JPEG ou WEBP',
      'bannerInput.max'    => 'O Arquivo enviado do banner de perfil é muito grande (Max: 4Mb)'
    ]);
  }

  public static function updateProfile(Request $request, UserModel $user){
    $user->username = $request->input('nameInput');
    $user->description = $request->input('descriptionInput');
    $user->updated_at = Carbon::now();
    ImageModel::processProfileImageUpdate($request, $user);
    ImageModel::processBannerImageUpdate($request, $user);
    $user->save();
    $user = UserModel::find($user->id);
    session()->forget('user');
    session(['user'=>AuthClass::getUserInfos($user)]);
  }
}