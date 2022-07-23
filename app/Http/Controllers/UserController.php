<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct()
    {
        $this->repo = new UserRepository( new \App\Models\User() );
    }

    public function register(Request $request)
    {
        $result = $this->repo->user_register($request);
        if($result instanceof \Exception)
        {
            return custom_response(false,null,$result->getMessage());
        }
        return custom_response(true ,"success register", null, $result->toArray());
    }

    public function login(Request $request)
    {
        $result = $this->repo->user_login($request);
        if($result instanceof \Exception)
        {
            return custom_response(false,null,$result->getMessage());
        }
        return custom_response(true,"login success", null, $result);
    }
}
