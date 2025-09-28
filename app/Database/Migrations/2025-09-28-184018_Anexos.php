<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anexos extends Migration
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
            'mensagem_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('mensagem_id', 'mensagens', 'id');

        $this->forge->createTable('anexos');
    }

    public function down()
    {
        $this->forge->dropTable('anexos');
    }
}
