<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'job' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'isCompleted' => [
                'type' => 'BOOLEAN'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('todos', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('todos', TRUE);
    }
}
