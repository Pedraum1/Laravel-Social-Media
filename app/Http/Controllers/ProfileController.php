<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Profile;
use App\Models\User;

class ProfileController extends Controller
{

    public function profile($tag){
        $profile = User::getUserByTag($tag);
        if(empty($profile)){
            return redirect()->back();
        }
        $profile_data = Profile::organizeProfileData($profile);
        return view('profile',$profile_data);
    }

    public function updateProfile(Request $request){
        Profile::validateLoginUpdate($request);
        $user = User::getUserByTag(session('user.tag'));
        Profile::updateProfile($request,$user);
        return redirect()->back();
    }
}
