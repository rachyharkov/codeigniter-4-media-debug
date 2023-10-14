<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersDocument extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users_documents');

    }

    public function down()
    {
        $this->forge->dropTable('users_documents');
    }
}
