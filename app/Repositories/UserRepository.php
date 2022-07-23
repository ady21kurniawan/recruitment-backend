<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository 
{
    public function __construct( \App\Models\User $model )
    {
        $this->model = $model;
    }

    public function user_register(Request $input )
    {
        $validation = Validator::make( $input->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' =>'required|string|min:5'
        ]);

        if($validation->fails())
        {
            return new \Exception($validation->errors()->first());
        }

        $is_user_exists = $this->model::whereEmail($input->email)->first();
        if( $is_user_exists )
        {
            return new \Exception("username or email is exists");
        }
            
        $user = $this->model::create([
            'name' => $input->name,
            'email' => $input->email,
            'password' => Hash::make($input->password)
        ]);

        return $user;
    }

    public function user_login(Request $params)
    {
        $checking = Auth::attempt([
            "email"=>$params->email,
            "password"=>$params->password
        ]); 
       
        if(! $checking)
        {
            return new \Exception("login failed");
        }

        $user = Auth::user();
        $token = $user->createToken('app_token')->accessToken;
        $user = $user->toArray();
        $user["token"] = "Bearer {$token}";
        
        return $user;
    }
}
