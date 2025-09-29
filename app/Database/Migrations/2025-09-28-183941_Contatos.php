<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contatos extends Migration
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
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => true,
            ],
            'matricula' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'unique' => true,
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
        $this->forge->createTable('contatos');
    }

    public function down()
    {
        $this->forge->dropTable('contatos', true, true);
    }
}
