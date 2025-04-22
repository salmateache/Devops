<?php

namespace App\Controllers;

use App\Models\SalmaModel;

class SalmaController extends BaseController
{
    public function index()
    {
        $model = new SalmaModel();
        $data['users'] = $model->findAll();
        return view('user_list', $data);
    }

    public function create()
    {
        return view('create_user');
    }
}
?>
