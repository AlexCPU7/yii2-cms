<?php

namespace common\modules\shop\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "module_shop_equipment".
 *
 * @property int $id
 * @property int $category_id
 * @property int $type_id
 * @property int $item_id
 *
 * @property Category $category
 * @property EquipmentType $item
 * @property Item $type
 * @property EquipmentItem[] $moduleShopEquipmentItems
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'type_id', 'item_id'], 'required'],
            [['category_id', 'type_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            //[['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipmentType::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['item_id'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'category_id' => Yii::t('shop', 'Category ID'),
            'type_id' => Yii::t('shop', 'Type ID'),
            'item_id' => Yii::t('shop', 'Item ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EquipmentType::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleShopEquipmentItems()
    {
        return $this->hasMany(EquipmentItem::className(), ['equipment_id' => 'id']);
    }

    public function getListType(){
        return ArrayHelper::map(EquipmentType::find()->all(), 'id', 'title');
    }

    public function getListItem(){
        return ArrayHelper::map(Item::find()->all(), 'id', 'title');
    }
}
