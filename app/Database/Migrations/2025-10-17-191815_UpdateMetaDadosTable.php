<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateMetaDadosTable extends Migration
{
    public function up()
    {
        // Remover a coluna antiga (e chave estrangeira associada)
        if ($this->db->fieldExists('embeddings_id', 'meta_dados')) {
            // Primeiro, remover a foreign key (se existir)
            $this->forge->dropForeignKey('meta_dados', 'meta_dados_embeddings_id_foreign');
            
            // Depois, remover a coluna
            $this->forge->dropColumn('meta_dados', 'embeddings_id');
        }

        // Adicionar novas colunas e chaves estrangeiras
        $fields = [
            'embeddings_rag_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'embeddings_filtro_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ];

        $this->forge->addColumn('meta_dados', $fields);
    }

    public function down()
    {
        // Remover as novas colunas
        $this->forge->dropColumn('meta_dados', ['embeddings_rag_id', 'embeddings_filtro_id']);

        // Recriar a coluna antiga
        $fields = [
            'embeddings_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ];

        $this->forge->addColumn('meta_dados', $fields);
        $this->forge->addForeignKey('embeddings_id', 'embeddings', 'id', 'CASCADE', 'SET NULL');
    }
}
