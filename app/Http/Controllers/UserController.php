<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware("auth");
    }

    public function index($nickname)
    {
        $User = User::GetUserByNickname($nickname);
        //this line checks if the user owns the profile
        $this->authorize("viewany", $User);

        return view("profile", [
            "User" => User::AuthUser(),
        ]);
    }


    

    public function update($nickname, Request $request)
    {
        //this line checks if the user owns the profile
        $this->authorize("update", auth()->user());
        
        $user = User::GetUserByNickname($nickname);
        
        $data = $this->IsProfileValid($request);

        
        //check if there's a profile image upload
        if(isset($request["profile_image"]))
        {
            $data["profile_image"] = $this->UploadImageProfile($request, $user);
        }
        
        $user->update($data);
        
        return view("profile", [
            "User" => $user,
        ]);

    }

    //upload profile image
    private function UploadImageProfile(Request $request, User $user)
    {
        
        //check if user is not using default image
        if(!preg_match("/default/", $user->profile_image))
        {
            //delete old images
            $old_profile_image= $user->profile_image;
            unlink(public_path("/storage/".$old_profile_image));
        }
        
        $imageStoreAt = $request->profile_image->store("profile/images", "public");
        
        Image::make(public_path("/storage/".$imageStoreAt))->fit(800,1000)->save();
        
        return $imageStoreAt;

    }
    //validate the profile for modification and returns any fields not null
    private function IsProfileValid(Request $request)
    {
        $data = $request->validate([
            "firstName" => "nullable|string|max:20",
            "lastName" => "nullable|string|max:50",
            "nickname" => "nullable|string|max:20:unique:users",
            "email"=> "nullable|email|max:255|unique:users",
            "profile_image" => "image|mimes:png,jpg,jpeg|nullable",
            "description" => "string|nullable",
        ]);

        foreach($data as $column=>$value)
        {
            if($data[$column] == null) unset($data[$column]);
        }

        return $data;
    }

    //Get autheticated user with ajax.
    public function auth_user()
    {
        return Auth::user();
    }
}
