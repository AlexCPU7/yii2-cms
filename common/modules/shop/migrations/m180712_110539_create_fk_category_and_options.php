<?php

use yii\db\Migration;

/**
 * Class m180712_110539_create_fk_category_and_options
 */
class m180712_110539_create_fk_category_and_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-module_shop_options-module_shop_category',
            'module_shop_options',
            'category_id',
            'module_shop_category',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_options_item-module_shop_options',
            'module_shop_options_item',
            'options_id',
            'module_shop_options',
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
            'fk-module_shop_options_item-module_shop_options',
            'module_shop_options_item'
        );

        $this->dropForeignKey(
            'fk-module_shop_options-module_shop_category',
            'module_shop_options'
        );
    }

}
