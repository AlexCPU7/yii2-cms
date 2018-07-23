<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_item_stickers".
 *
 * @property int $item_id
 * @property int $stickers_id
 *
 * @property Item $item
 * @property Stickers_id $stickers0
 */
class ItemStickers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_item_stickers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'stickers_id'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['stickers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stickers::className(), 'targetAttribute' => ['stickers_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('shop', 'Item ID'),
            'stickers_id' => Yii::t('shop', 'Stickers ID'),
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
    public function getStickers0()
    {
        return $this->hasOne(Stickers::className(), ['id' => 'stickers_id']);
    }
}
