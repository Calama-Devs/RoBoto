<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFksToMetaDados extends Migration
{
    public function up()
    {
        // 1) adicionar FKs (ignora erros se já existirem)
        try {
            $this->db->simpleQuery("
                ALTER TABLE `meta_dados`
                  ADD CONSTRAINT `fk_meta_dados_embeddings_rag_id`
                    FOREIGN KEY (`embeddings_rag_id`) REFERENCES `embeddings_rag`(`id`)
                    ON DELETE SET NULL ON UPDATE CASCADE,
                  ADD CONSTRAINT `fk_meta_dados_embeddings_filtro_id`
                    FOREIGN KEY (`embeddings_filtro_id`) REFERENCES `embeddings_filtro`(`id`)
                    ON DELETE SET NULL ON UPDATE CASCADE
            ");
        } catch (\Exception $e) {
        }

        try {
            $this->db->simpleQuery("ALTER TABLE `meta_dados` DROP FOREIGN KEY `meta_dados_embedding_id_foreign`");
        } catch (\Exception $e) {}

        try {
            $this->db->simpleQuery("ALTER TABLE `meta_dados` DROP INDEX `meta_dados_embedding_id_foreign`");
        } catch (\Exception $e) {}

        try {
            $this->db->simpleQuery("ALTER TABLE `meta_dados` DROP COLUMN `embedding_id`");
        } catch (\Exception $e) {}
    }

    public function down()
    {
        try {
            $this->db->simpleQuery("ALTER TABLE `meta_dados` DROP FOREIGN KEY `fk_meta_dados_embeddings_rag_id`");
        } catch (\Exception $e) {}
        try {
            $this->db->simpleQuery("ALTER TABLE `meta_dados` DROP FOREIGN KEY `fk_meta_dados_embeddings_filtro_id`");
        } catch (\Exception $e) {}

        try {
            $this->db->simpleQuery("ALTER TABLE `meta_dados` ADD COLUMN `embedding_id` INT(11) UNSIGNED NOT NULL AFTER `id`");
            $this->db->simpleQuery("
                ALTER TABLE `meta_dados`
                ADD CONSTRAINT `meta_dados_embedding_id_foreign`
                  FOREIGN KEY (`embedding_id`) REFERENCES `embeddings`(`id`)
                  ON DELETE RESTRICT ON UPDATE CASCADE
            ");
        } catch (\Exception $e) {}
    }
}
