<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\FactureModel;

class FactureModelTest extends TestCase
{
    use DatabaseTestTrait;

    // Pour que les données restent dans la base après chaque test (attention en production)
    protected $disableTransaction = true;
    protected $seed = '';

    protected function setUp(): void
    {
        parent::setUp();

        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        if (!$db->tableExists('facture')) {
            $fields = [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'DateFacture' => [
                    'type' => 'DATE',
                ],
                'client' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'total' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
                ],
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            $forge->createTable('facture');
        }

        // Nettoyer la table avant chaque test
        $db->table('facture')->truncate();
    }

    public function testInsertFacture(): void
    {
        $model = new FactureModel();

        $data = [
            'DateFacture' => '2025-04-23',
            'client'      => 'Client Alpha',
            'total'       => 150.75,
        ];

        $id = $model->insert($data);

        $this->assertGreaterThan(0, $id);
        $facture = $model->find($id);

        $this->assertEquals('2025-04-23', $facture['DateFacture']);
        $this->assertEquals('Client Alpha', $facture['client']);
        $this->assertEquals(150.75, $facture['total']);
    }

    public function testTotalGreaterThanZero(): void
    {
        $model = new FactureModel();

        $data = [
            'DateFacture' => '2025-04-22',
            'client'      => 'Client Beta',
            'total'       => 80.00,
        ];

        $id = $model->insert($data);
        $facture = $model->find($id);

        $this->assertGreaterThan(0, $facture['total'], 'Le montant de la facture doit être supérieur à 0');
    }

    public function testMultipleInsertions(): void
    {
        $model = new FactureModel();

        $id1 = $model->insert([
            'DateFacture' => '2025-04-20',
            'client'      => 'Client Gamma',
            'total'       => 120.00,
        ]);

        $id2 = $model->insert([
            'DateFacture' => '2025-04-21',
            'client'      => 'Client Delta',
            'total'       => 95.50,
        ]);

        $this->assertNotNull($model->find($id1));
        $this->assertNotNull($model->find($id2));
    }
}
