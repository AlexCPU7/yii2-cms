<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            //'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addColumn('user', 'first_name', $this->string());

        $this->addColumn('user', 'last_name', $this->string());

        $this->addColumn('user', 'middle_name', $this->string());

        $this->addColumn('user', 'phone', $this->string());

        $this->createTable('user_avatar', [
            'user_id' => $this->integer()->notNull(),
            'avatar' => $this->string()
        ]);

        $this->createIndex(
            'idx-user_avatar-user_id',
            'user_avatar',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_avatar-user',
            'user_avatar',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addColumn('user', 'check_email', $this->integer(1));

        $this->addColumn('user', 'check_phone', $this->integer(1));

        $this->createTable('info_site', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'bot_title' => $this->string(),
            'descr' => $this->text(),
            'letter_email' => $this->string(),
            'letter_email_pass' => $this->string(),
            'letter_phone' => $this->string(),
            'supp_email' => $this->string(),
            'supp_phone' => $this->string(),
        ]);

        $this->addColumn('user', 'email_confirm_token', $this->string());

        $this->addColumn('user', 'phone_confirm_token', $this->string());

        $this->createTable('notice', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);

        $this->createTable('notice_user', [
            'notice_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-notice_user-notice_id',
            'notice_user',
            'notice_id'
        );

        $this->createIndex(
            'idx-notice_user-user_id',
            'notice_user',
            'user_id'
        );

        $this->addForeignKey(
            'fk-notice_user-notice',
            'notice_user',
            'notice_id',
            'notice',
            'id',
            'CASCADE'
        );


        $this->addForeignKey(
            'fk-notice_user-user',
            'notice_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-notice_user-user',
            'notice_user'
        );

        $this->dropForeignKey(
            'fk-notice_user-notice',
            'notice_user'
        );

        $this->dropIndex(
            'idx-notice_user-user_id',
            'notice_id'
        );

        $this->dropIndex(
            'idx-notice_user-notice_id',
            'notice_id'
        );

        $this->dropTable('notice_user');

        $this->dropTable('notice');

        $this->dropColumn('user', 'phone_confirm_token');

        $this->dropColumn('user', 'email_confirm_token');

        $this->dropTable('info_site');

        $this->dropColumn('user', 'check_phone');

        $this->dropColumn('user', 'check_email');

        $this->dropForeignKey(
            'fk-user_avatar-user',
            'user_avatar'
        );

        $this->dropIndex(
            'idx-user_avatar-user_id',
            'user_avatar'
        );

        $this->dropTable('user_avater');

        $this->dropColumn('user', 'phone');

        $this->dropColumn('user', 'middle_name');

        $this->dropColumn('user', 'last_name');

        $this->dropColumn('user', 'first_name');

        $this->dropTable('{{%user}}');
    }
}
