<?php

use yii\db\Migration;

class m180201_164810_user_roles extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-user-roles',
            'user',
            'role',
            'roles',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user-roles',
            'user'
        );
    }
}
