<?php

namespace Tests;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\MeryemModel;

class MeryemModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $seed = ''; // pas de fichier seed, on crée les données à la main

    protected function setUp(): void
    {
        parent::setUp();

        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        // Créer la table si elle n'existe pas
        if (!$db->tableExists('users')) {
            $fields = [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            $forge->createTable('users');
        }

        // Nettoyer la table pour éviter les doublons
        $db->table('users')->truncate();
    }

    public function testFindAllUsers()
    {
        $model = new MeryemModel();
        $users = $model->findAll();
        $this->assertIsArray($users);
    }

    public function testInsertUser()
    {
        $model = new MeryemModel();
        $data = ['name' => 'Jamila Dahi', 'email' => 'jda@g.mt'];
        $id = $model->insert($data);
        $this->assertGreaterThan(0, $id);
    }
}
