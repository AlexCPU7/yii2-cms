<?php

use yii\db\Migration;

class m180201_162518_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull(),
            'login' => $this->string(100)->notNull(),
            'password_hash' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'role' => $this->integer(),
            'status' => $this->integer(),
        ]);

        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'role' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user');
        $this->dropTable('roles');
    }
}
