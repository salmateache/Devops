<?php

namespace Tests;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\ArticleModel;

class ArticleModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $db    = \Config\Database::connect();
        $forge = \Config\Database::forge();

        // Créer la table 'article' si elle n'existe pas
        if (! $db->tableExists('article')) {
            $fields = [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'ref' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'qte' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                ],
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            $forge->createTable('article', true);
        }

        // Truncate la table avant chaque test
        $db->table('article')->truncate();
    }

   
    public function testUpdateArticle()
    {
        $model = new ArticleModel();
        $data  = [
            'ref' => 'REF123',
            'qte' => 10,
        ];
        $id = $model->insert($data);
        $this->assertIsInt($id, 'insert() doit renvoyer un entier');
        $newData = [
            'ref' => 'NEWREF456',
            'qte' => 20,
        ];
        $updated = $model->update($id, $newData);
        $this->assertTrue(
            $updated,
            "update({$id}) doit renvoyer true"
        );
        $article = $model->find($id);
        $this->assertNotNull($article, "L'article (#{$id}) doit exister après mise à jour");
        $this->assertEquals('NEWREF456', $article['ref']);
        $this->assertEquals(20, $article['qte']);
    }
}
