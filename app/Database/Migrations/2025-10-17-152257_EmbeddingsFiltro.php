<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmbeddingsFiltro extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'contexto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'vetor' => [
                'type'       => 'TEXT', // Assumindo que o vetor pode ser grande, no documento estava varchar, mas TEXT é mais apropriado para grandes quantidades de dados
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('embeddings_filtro');
    }

    public function down()
    {
        $this->forge->dropTable('embeddings_filtro');
    }
}
