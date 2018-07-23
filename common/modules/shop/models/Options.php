<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_options".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property int $order
 * @property int $active
 * @property int $active_filter
 *
 * @property Category $category
 * @property OptionsItem[] $moduleShopOptionsItems
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title'], 'required'],
            [['category_id', 'order', 'active', 'active_filter'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'title' => Yii::t('shop', 'Title'),
            'order' => Yii::t('shop', 'Order'),
            'active' => Yii::t('shop', 'Active'),
            'active_filter' => Yii::t('shop', 'Active Filter'),
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
    public function getOptionsItems()
    {
        return $this->hasMany(OptionsItem::className(), ['options_id' => 'id']);
    }
}
