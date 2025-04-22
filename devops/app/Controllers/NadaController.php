<?php

namespace App\Controllers;

use App\Models\NadaModel;

class NadaController extends BaseController
{
    public function index()
    {
        $model = new NadaModel();
        $data['users'] = $model->findAll();
        return view('user_list', $data);
    }

    public function create()
    {
        return view('create_user');
    }
}
?>
