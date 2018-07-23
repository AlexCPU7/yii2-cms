<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_item_img".
 *
 * @property int $item_id
 * @property string $path
 *
 * @property Item $item
 */
class ItemImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_item_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'path'], 'required'],
            [['item_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('shop', 'Item ID'),
            'path' => Yii::t('shop', 'Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
