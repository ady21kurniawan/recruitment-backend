<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $valid = Validator::make( $request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' =>'required|string|min:5'
        ]);

        if($valid->fails())
        {
           return custom_response(false,null,$valid->errors()->first());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return custom_response(true ,"success register", null, $user->toArray());
    }

    public function login(Request $request)
    {
        $checking = Auth::attempt([
            "email"=>$request->email,
            "password"=>$request->password
        ]); 
       
        if(! $checking)
        {
            return custom_response(false,null, "login failed");
        }

        $user = Auth::user();
        $token = $user->createToken('app_token')->accessToken;
        
        $user = $user->toArray();
        $user["token"] = "Bearer {$token}";
        return custom_response(true,"login success", null, $user);
    }
}
