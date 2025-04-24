<?php

namespace App\Controllers;

use App\Models\FactureModel;
use CodeIgniter\Controller;

class FactureController extends BaseController
{
    public function index()
    {
        $model = new FactureModel();
        $data['factures'] = $model->findAll();

        return view('facture_view', $data);
    }

    public function create()
    {
        return view('facture_create');
    }

    public function store()
    {
        $model = new FactureModel();

        $model->save([
            'DateFacture' => $this->request->getPost('DateFacture'),
            'client'      => $this->request->getPost('client'),
            'total'       => $this->request->getPost('total'),
        ]);

        return redirect()->to('/facture');
    }

    public function delete($id)
    {
        $model = new FactureModel();
        $model->delete($id);

        return redirect()->to('/facture');
    }
}
