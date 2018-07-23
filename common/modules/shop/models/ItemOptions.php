<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_item_options".
 *
 * @property int $item_id
 * @property int $options_id
 * @property int $options_item_id
 *
 * @property Item $item
 * @property Options $options
 * @property OptionsItem $optionsItem
 */
class ItemOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_item_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'options_id', 'options_item_id'], 'required'],
            [['item_id', 'options_id', 'options_item_id'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['options_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['options_id' => 'id']],
            [['options_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => OptionsItem::className(), 'targetAttribute' => ['options_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('shop', 'Item ID'),
            'options_id' => Yii::t('shop', 'Options ID'),
            'options_item_id' => Yii::t('shop', 'Options Item ID'),
        ];
    }

    public static function primaryKey()
    {
        return [
            'item_id',
            'options_id'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasOne(Options::className(), ['id' => 'options_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionsItem()
    {
        return $this->hasOne(OptionsItem::className(), ['id' => 'options_item_id']);
    }
}
