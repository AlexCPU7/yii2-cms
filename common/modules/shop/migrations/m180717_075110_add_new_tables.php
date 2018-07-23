<?php

use yii\db\Migration;

/**
 * Class m180717_075110_add_new_tables
 */
class m180717_075110_add_new_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('module_shop_equipment_item', [
            'item_id' => $this->integer()->notNull(),
            'equipment_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-module_shop_equipment_item-item_id',
            'module_shop_equipment_item',
            'item_id'
        );

        $this->createTable('module_shop_equipment', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('module_shop_equipment_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('module_shop_equipment_type');

        $this->dropTable('module_shop_equipment');

        $this->dropIndex(
            'idx-module_shop_equipment_item-item_id',
            'module_shop_equipment_item'
        );

        $this->dropTable('module_shop_equipment_item');
    }
}
