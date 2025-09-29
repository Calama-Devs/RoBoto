<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MetaDados extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'embedding_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'chave' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'valor' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('embedding_id', 'embeddings', 'id');

        $this->forge->createTable('meta_dados');
    }

    public function down()
    {
        $this->forge->dropTable('meta_dados', true, true);
    }
}
