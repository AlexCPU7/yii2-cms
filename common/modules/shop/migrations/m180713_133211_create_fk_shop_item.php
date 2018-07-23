<?php

use yii\db\Migration;

/**
 * Class m180713_133211_create_fk_shop_item
 */
class m180713_133211_create_fk_shop_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-module_shop_item_img-module_shop_item',
            'module_shop_item_img',
            'item_id',
            'module_shop_item',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_item_stickers-module_shop_item',
            'module_shop_item_stickers',
            'item_id',
            'module_shop_item',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_item_stickers-module_shop_stickers',
            'module_shop_item_stickers',
            'stickers_id',
            'module_shop_stickers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_item-module_shop_category',
            'module_shop_item',
            'category_id',
            'module_shop_category',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_item_options-module_shop_item',
            'module_shop_item_options',
            'item_id',
            'module_shop_item',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_item_options-module_shop_options',
            'module_shop_item_options',
            'options_id',
            'module_shop_options',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_item_options-module_shop_options_item',
            'module_shop_item_options',
            'options_item_id',
            'module_shop_options_item',
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
            'fk-module_shop_item_options-module_shop_options_item',
            'module_shop_item_options'
        );

        $this->dropForeignKey(
            'fk-module_shop_item_options-module_shop_options',
            'module_shop_item_options'
        );

        $this->dropForeignKey(
            'fk-module_shop_item_options-module_shop_item',
            'module_shop_item_options'
        );

        $this->dropForeignKey(
            'fk-module_shop_item-module_shop_category',
            'module_shop_item'
        );

        $this->dropForeignKey(
            'fk-module_shop_item_stickers-module_shop_stickers',
            'module_shop_item_stickers'
        );

        $this->dropForeignKey(
            'fk-module_shop_item_stickers-module_shop_item',
            'module_shop_item_stickers'
        );

        $this->dropForeignKey(
            'fk-module_shop_item_img-module_shop_item',
            'module_shop_item_img'
        );
    }

}
