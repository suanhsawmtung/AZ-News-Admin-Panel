<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // log in for user //
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();

        if(isset($user)){
            if(Hash::check($request->password,$user->password)){
                return response()->json([
                    "user" => $user,
                    "token" => $user->createToken(time())->plainTextToken,
                    "status" => null,
                    "message" => "Log in success."
                ]);
            }else {
                return response()->json([
                    "user" => null,
                    "token" => null,
                    "status" => "password",
                    "message" => "The password you entered is not correct."
                ]);
            }
        }else {
            return response()->json([
                "user" => null,
                "token" => null,
                "status" => "email",
                "message" => "The email you entered is not matched."
            ]);
        }
    }

    // register //
    public function register(Request $request){
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ];

        User::create($data);
        $user = User::where('email',$request->email)->first();
        return response()->json([
            "user" => $user,
            "token" => $user->createToken(time())->plainTextToken
        ]);
    }
}
