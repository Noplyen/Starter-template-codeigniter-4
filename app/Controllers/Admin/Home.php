<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/home');
    }

    public function getData()
    {
        $userService = Services::userService();

        $data = $userService->getAllUsers();

        return $this->response->setJSON(["data"=>$data]);
    }
}