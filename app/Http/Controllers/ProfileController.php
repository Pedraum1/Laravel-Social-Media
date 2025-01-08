<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUpdateRequest;
use App\Models\UserModel;
use App\Models\ImageModel;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function profile($tag){
        $profile = UserModel::getUserByTag($tag);

        if(empty($profile)){
            return redirect()->back();
        }
        $profile_data = $this->ProfileData($profile);

        return view('profile',$profile_data);
    }

    public function updateProfile(LoginUpdateRequest $request){
        $credentials = $request->validated();
        $user = UserModel::getUserByTag(session('user.tag'));

        $this->updateUserProfile($credentials,$user);
        return redirect()->back();
    }

    private function ProfileData(UserModel $user){
        return [
            'username'      => $user->username,
            'description'   => $user->description,
            'tag'           => $user->tag,
            'followers_num' => $user->followersNumber,
            'following_num' => $user->followingNumber,
            'posts_num'     => $user->postsNumber,
            'profile_img'   => $user->profile_image,
            'banner_img'    => $user->banner_image,
            'posts'         => $user->posts
        ];
      }

    private function updateUserProfile(array $credentials, UserModel $user):void{

        $this->processImageUpdate($credentials, $user);
        $user->save([
            "username"    => $credentials['nameInput'],
            "description" => $credentials['descriptionInput']
        ]);

        $user->refresh();
        $this->updateSession($user);
    }

    private function updateSession(UserModel $user):void{
        session()->forget('user');
        session(['user'=>$user->getInfos()]);
    }

    private function processImageUpdate(array $credentials, UserModel $user): void {
        if(!empty($credentials['profileInput'])){
            $this->updateProfileImage($credentials, $user);
        }

        if(!empty($credentials['bannerInput'])){
            $this->updateBannerImage($credentials, $user);
        }
    }

    private function updateProfileImage(array $credentials, UserModel $user) {
        $old_image = ImageModel::find($user->profile_image->id);
        $new_name = $this->storeNewImage($credentials);
        $old_image->update(["name"=>$new_name]);
    }

    private function updateBannerImage(array $credentials, UserModel $user): void {
        $old_image = ImageModel::find($user->banner_image->id);
        $new_name = $this->storeNewImage($credentials);
        $old_image->update(["name"=>$new_name]);
    }
    
    private function storeNewImage(array $credentials): string {
        $new_image = $credentials["profileInput"];
        $new_name = $this->generateImageName($new_image->getClientOriginalName());
        $new_image->storeAs('images',$new_name,'public');

        return $new_name;
    }

    private function generateImageName(string $file_name): string{
        return Carbon::now()->format('Y-m-d_H-i-s').'-'.$file_name;
    }

}
