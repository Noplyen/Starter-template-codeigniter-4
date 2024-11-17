<?php

namespace App\Controllers;

use App\Models\Users\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        var_dump($userModel->getUserDetails("user@gmail.com"));
//        return view('auth/login');
    }
}
