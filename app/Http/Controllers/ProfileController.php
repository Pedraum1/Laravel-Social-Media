<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ProfileClass;
use App\Models\UserModel;

class ProfileController extends Controller
{

    public function profile($tag){
        $profile = UserModel::getUserByTag($tag);
        if(empty($profile)){
            return redirect()->back();
        }
        $profile_data = ProfileClass::organizeProfileData($profile);
        return view('profile',$profile_data);
    }

    public function updateProfile(Request $request){
        ProfileClass::validateLoginUpdate($request);
        $user = UserModel::getUserByTag(session('user.tag'));
        ProfileClass::updateProfile($request,$user);
        return redirect()->back();
    }
}
