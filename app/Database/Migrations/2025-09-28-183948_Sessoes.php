<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sessoes extends Migration
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
            'contato_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'avaliacao_pontos' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'avaliacao_comentario' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                 'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME', 
                'null' => true
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('contato_id', 'contatos', 'id');
        $this->forge->createTable('sessoes');
    }

    public function down()
    {
        $this->forge->dropTable('sessoes');
    }
}
