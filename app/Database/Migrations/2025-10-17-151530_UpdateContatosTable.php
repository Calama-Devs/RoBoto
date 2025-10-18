<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateContatosTable extends Migration
{
    public function up()
    {
        $fields = [
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ];

        $this->forge->addColumn('contatos', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('contatos', 'nome');
    }
}
