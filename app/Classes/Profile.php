<?php

namespace App\Classes;

use App\Models\User;

class Profile{

  public static function profileImage(User $user): string{
    if($user->profile_image != null){
      return $user->profile_image->name;
    }
    return 'noProfile.webp';
  }

  public static function bannerImage(User $user): string{
    if($user->banner_image != null){
      return $user->banner_image->name;
    }
    return 'noProfile.webp';
  }

  public static function organizeProfileData(User $user){

    $profile_image = Profile::profileImage($user);
    $banner_image = Profile::bannerImage($user);
        return [
          'username'=>$user->username,
          'description'=>$user->description,
          'tag'=>$user->tag,
          'followers_num'=>$user->followersNumber,
          'following_num'=>$user->followingNumber,
          'posts_num'=>$user->postsNumber,
          'profile_img'=>$profile_image,
          'banner_img'=>$banner_image
        ];
  }
}