<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_stickers".
 *
 * @property int $id
 * @property string $title
 *
 * @property ItemStickers[] $moduleShopItemStickers
 */
class Stickers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_stickers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
    public function getModuleShopItemStickers()
    {
        return $this->hasMany(ItemStickers::className(), ['stickers' => 'id']);
    }
}
