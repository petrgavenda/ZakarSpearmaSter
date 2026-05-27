<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasswordTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'null'           => false,
            ],
            'text' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
                'unique'     => true,
            ],
            'hash_md5' => [
                'type'       => 'CHAR',
                'constraint' => '32',
                'null'       => true,
            ],
            'hash_ripemd' => [
                'type'       => 'CHAR',
                'constraint' => '40',
                'null'       => true,
            ],
            'hash_sha256' => [
                'type'       => 'CHAR',
                'constraint' => '64',
                'null'       => true,
            ],
            'website_id' => [
                'type'       => 'INT',
                'null'       => true, //přenastavit na false až nebudeš pepek
            ],
            'search_people_id' => [
                'type'       => 'INT',
                'null'       => true, //přenastavit na false až nebudeš pepek
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('website_id');
        $this->forge->addKey('search_people_id');
        
        $this->forge->addForeignKey('website_id', 'website', 'id', 'NO ACTION', 'NO ACTION');
        $this->forge->addForeignKey('search_people_id', 'search_people', 'id', 'NO ACTION', 'NO ACTION');

        $this->forge->createTable('password', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('password');
    }
}
