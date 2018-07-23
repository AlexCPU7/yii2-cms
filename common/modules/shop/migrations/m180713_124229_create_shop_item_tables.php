<?php

use yii\db\Migration;

/**
 * Class m180713_124229_create_shop_item_tables
 */
class m180713_124229_create_shop_item_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('module_shop_item', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'active' => $this->integer(1),
            'title' => $this->string()->notNull(),
            'price_rub' => $this->decimal(12,2),
            'price_usd' => $this->decimal(12,2),
            'price_eur' => $this->decimal(12,2),
            'url' => $this->string(),
            'descr' => $this->text(),
            'sort' => $this->integer(),
            'create_tm' => $this->dateTime(),
            'update_tm' => $this->dateTime(),
        ]);

        $this->createTable('module_shop_item_options', [
            'item_id' => $this->integer()->notNull(),
            'options_id' => $this->integer()->notNull(),
            'options_item_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-module_shop_item_options-item_id',
            'module_shop_item_options',
            'item_id'
        );

        $this->createTable('module_shop_item_img', [
            'item_id' => $this->integer()->notNull(),
            'path' => $this->string()->notNull()
        ]);

        $this->createIndex(
            'idx-module_shop_item_img-path',
            'module_shop_item_img',
            'path'
        );

        $this->createTable('module_shop_stickers', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);

        $this->createTable('module_shop_item_stickers', [
            'item_id' => $this->integer(),
            'stickers_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-module_shop_item_stickers-item_id',
            'module_shop_item_stickers',
            'item_id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
        'idx-module_shop_item_stickers-item_id',
            'module_shop_item_stickers'
        );

        $this->dropTable('module_shop_item_stickers');

        $this->dropTable('module_shop_stickers');

        $this->dropIndex(
            'idx-module_shop_item_img-path',
            'module_shop_item_img'
        );

        $this->dropTable('module_shop_item_img');

        $this->dropIndex(
            'idx-module_shop_item_options-item_id',
            'module_shop_item_options'
        );

        $this->dropTable('module_shop_item_options');

        $this->dropTable('module_shop_item');
    }

}
