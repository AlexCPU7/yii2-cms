<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_options_item".
 *
 * @property int $id
 * @property int $options_id
 * @property string $title
 * @property string $url
 * @property int $sort
 *
 * @property Options $options
 */
class OptionsItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_options_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['options_id', 'title'], 'required'],
            [['options_id', 'sort'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['options_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['options_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'options_id' => Yii::t('shop', 'Options ID'),
            'title' => Yii::t('shop', 'Title'),
            'url' => Yii::t('shop', 'Url'),
            'sort' => Yii::t('shop', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasOne(Options::className(), ['id' => 'options_id']);
    }
}
