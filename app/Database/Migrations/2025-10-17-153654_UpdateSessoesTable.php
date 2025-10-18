<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateSessoesTable extends Migration
{
    public function up()
    {
        $fields = [
            'ended_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('sessoes', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sessoes', 'ended_at');
    }
}
