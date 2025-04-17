<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('user_list', $data);
    }

    public function create()
    {
        return view('create_user');
    }
}
?>
