<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Embeddings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=> true,
                'auto_increment' => true,
            ],
            'contexto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'vetor' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('embeddings');
    }

    public function down()
    {
        $this->forge->dropTable('embeddings');
    }
}
