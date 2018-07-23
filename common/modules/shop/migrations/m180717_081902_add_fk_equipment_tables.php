<?php

use yii\db\Migration;

/**
 * Class m180717_081902_add_fk_equipment_tables
 */
class m180717_081902_add_fk_equipment_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-module_shop_equipment_item-module_shop_item',
            'module_shop_equipment_item',
            'item_id',
            'module_shop_item',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_equipment_item-module_shop_equipment',
            'module_shop_equipment_item',
            'equipment_id',
            'module_shop_equipment',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_equipment-module_shop_category',
            'module_shop_equipment',
            'category_id',
            'module_shop_category',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_equipment-module_shop_item',
            'module_shop_equipment',
            'type_id',
            'module_shop_item',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_shop_equipment-module_shop_equipment_type',
            'module_shop_equipment',
            'item_id',
            'module_shop_equipment_type',
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
            'fk-module_shop_equipment-module_shop_equipment_type',
            'module_shop_equipment'
        );

        $this->dropForeignKey(
            'fk-module_shop_equipment-module_shop_equipment_type',
            'module_shop_equipment'
        );

        $this->dropForeignKey(
            'fk-module_shop_equipment-module_shop_category',
            'module_shop_equipment'
        );

        $this->dropForeignKey(
            'fk-module_shop_equipment_item-module_shop_equipment',
            'module_shop_equipment_item'
        );

        $this->dropForeignKey(
            'fk-module_shop_equipment_item-module_shop_item',
            'module_shop_equipment_item'
        );
    }
}
