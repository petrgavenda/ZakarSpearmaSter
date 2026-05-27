<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWebsiteHasHashingFunctionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'website_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'hashing_function_id' => [
                'type' => 'INT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey(['website_id', 'hashing_function_id'], true);
        $this->forge->addKey('website_id');
        $this->forge->addKey('hashing_function_id');

        $this->forge->addForeignKey('website_id', 'website', 'id', 'NO ACTION', 'NO ACTION');
        $this->forge->addForeignKey('hashing_function_id', 'hashing_function', 'id', 'NO ACTION', 'NO ACTION');

        $this->forge->createTable('website_has_hashing_function', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('website_has_hashing_function');
    }
}
