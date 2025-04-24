<?php
namespace App\Controllers;
use App\Models\ArticleModel;
class ArticleController extends BaseController
{
    public function index()
    {
        $model = new ArticleModel();
        $data['article'] = $model->findAll();
        return view('user_list', $data);
    }
    public function create()
    {
        return view('create_user');
    }
}
?>
