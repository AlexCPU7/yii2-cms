<?php

use yii\db\Migration;

/**
 * Class m180727_104643_create_content_tables
 */
class m180727_104643_create_content_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('module_content', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'active' => $this->integer(),
            'title' => $this->string(),
            'sub_title' => $this->string(),
            'img' => $this->string(),
            'descr' => $this->text(),
            'link' => $this->string(),
            'title_anons' => $this->string(),
            'sub_title_anons' => $this->string(),
            'img_anons' => $this->string(),
            'descr_anons' => $this->text(),
            'link_anons' => $this->string(),
            'create_tm' => $this->dateTime()->notNull(),
            'update_tm' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('module_content_type', [
            'id' => $this->primaryKey(),
            'active' => $this->integer(),
            'title' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'create_tm' => $this->dateTime()->notNull(),
            'update_tm' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-module_content-module_content_type',
            'module_content',
            'type_id',
            'module_content_type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_content-module_user',
            'module_content',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-module_content-module_user',
            'module_content'
        );

        $this->dropForeignKey(
            'fk-module_content-module_content_type',
            'module_content'
        );

        $this->dropTable('module_content_type');

        $this->dropTable('module_content');
    }

}
