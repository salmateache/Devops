<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\NadaModel;

class NadaModelTest extends TestCase
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

    public function testFindAllUsers(): void
    {
        $model = new NadaModel();
        $users = $model->findAll();
        $this->assertIsArray($users);
    }

    public function testInsertUser(): void
    {
        $model = new NadaModel();
        $data = ['name' => 'Jamila Dahi', 'email' => 'jda@g.mt'];
        $id = $model->insert($data);
        $this->assertGreaterThan(0, $id);
    }
}
