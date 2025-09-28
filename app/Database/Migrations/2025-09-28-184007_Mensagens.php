<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mensagens extends Migration
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
            'texto' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'timestamp' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'remetente' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'score_filtro' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'sessao_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('contato_id', 'contatos', 'id');
        $this->forge->addForeignKey('sessao_id', 'sessoes', 'id');

        $this->forge->createTable('mensagens');
    }

    public function down()
    {
        $this->forge->dropTable('mensagens');
    }
}
