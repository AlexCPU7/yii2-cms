<?php

use yii\db\Migration;

/**
 * Class m180712_104604_create_tables_module_shop
 */
class m180712_104604_create_tables_module_shop extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('module_shop_category', [
            'id' => $this->primaryKey(),
            'active' => $this->integer(1),
            'url' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'descr' => $this->text(),
            'order' => $this->integer(),
            'create_tm' => $this->dateTime()->notNull(),
            'update_tm' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('module_shop_options', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'order' => $this->integer(),
            'active' => $this->integer(1),
            'active_filter' => $this->integer(1),
        ]);

        $this->createTable('module_shop_options_item', [
            'id' => $this->primaryKey(),
            'options_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'url' => $this->string(),
            'sort' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('module_shop_options_item');

        $this->dropTable('module_shop_options');

        $this->dropTable('module_shop_category');
    }
}
