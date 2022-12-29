<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // admin -> direct my profile page //
    public function myProfilePage(){
        $item = User::where('id',Auth::user()->id)->first();
        return view('admin.profile.myProfile',compact('item'));
    }

    // admin -> update my data //
    public function updateMyData(Request $request){
        $this->validationForUpdateMyProfile($request);
        $data = $this->requestDataForUpdating($request);
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(["updateStatus" => "Updated profile datas successfully."]);
    }

    // admin -> direct change password page //
    public function passwordChangePage(){
        return view('admin.profile.changePassword');
    }

    // admin -> change password //
    public function changePassword(Request $request){
        $this->validationForPasswordChanging($request);
        $dbOldPassword = User::where('id',Auth::user()->id)->first();
        if(Hash::check($request->oldPassword,$dbOldPassword->password)){
            User::where('id',Auth::user()->id)->update(["password" => Hash::make($request->newPassword)]);
        }
        return redirect()->route('profile#passwordChangePage')->with(["oldPasswordError" => "The password you entered is mot matched with the old one."]);

    }

    // admin -> validation for update my profile //
    private function validationForUpdateMyProfile($request){
        Validator::make($request->all(),[
            "userName" => "required",
            "userEmail" => "required"
        ])->validate();
    }

    // admin -> request data to updatre my profile //
    private function requestDataForUpdating($request){
        return  [
            "name" => $request->userName,
            "email" => $request->userEmail,
            "phone" => $request->userPhone,
            "gender" => $request->userGender,
            "address" => $request->userAddress
        ];
    }

    // admin -> validate for password changing //
    private function validationForPasswordChanging($request){
        validator::make($request->all(),[
            "oldPassword" => "required",
            "newPassword" => "required | min:6 " ,
            "confirmPassword" => "required | same:newPassword"
        ])->validate();
    }
}
