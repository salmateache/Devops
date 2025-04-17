<?php

namespace App\Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\UserModel;

class UserModelTest extends TestCase
{
    public function testFindAllUsers()
    {
        $model = new UserModel();
        $users = $model->findAll();
        $this->assertIsArray($users, "findAll doit retourner un tableau !");
    }

    public function testInsertUser()
    {
        $model = new UserModel();
        $data = ['name' => 'Jamila Dahi', 'email' => 'jda@g.mt'];
        $id = $model->insert($data);
        $this->assertGreaterThan(0, $id, "L'ID de l'utilisateur inséré doit être > 0");
    }
}
?>
