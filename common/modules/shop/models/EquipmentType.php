<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_equipment_type".
 *
 * @property int $id
 * @property int $title
 *
 * @property Equipment[] $moduleShopEquipments
 */
class EquipmentType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_equipment_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'title' => Yii::t('shop', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleShopEquipments()
    {
        return $this->hasMany(Equipment::className(), ['item_id' => 'id']);
    }
}
