<?php

namespace App\Controllers;

use App\Models\MeryemModel;

class MeryemController extends BaseController
{
    public function index()
    {
        $model = new MeryemModel();
        $data['users'] = $model->findAll();
        return view('user_list', $data);
    }

    public function create()
    {
        return view('create_user');
    }
}
?>
