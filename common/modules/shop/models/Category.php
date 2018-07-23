<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_category".
 *
 * @property int $id
 * @property int $active
 * @property string $url
 * @property string $title
 * @property string $descr
 * @property int $order
 * @property string $create_tm
 * @property string $update_tm
 *
 * @property Options[] $moduleShopOptions
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_shop_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'order'], 'integer'],
            [['create_tm', 'update_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['url', 'title', 'create_tm', 'update_tm'], 'required'],
            [['url'], 'unique', 'targetClass' => '\common\modules\shop\models\Category', 'message' => Yii::t('shop', 'This name already exists.')],
            [['descr'], 'string'],
            [['create_tm', 'update_tm'], 'safe'],
            [['url', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'active' => Yii::t('shop', 'Active'),
            'url' => Yii::t('shop', 'Url'),
            'title' => Yii::t('shop', 'Title'),
            'descr' => Yii::t('shop', 'Descr'),
            'order' => Yii::t('shop', 'Order'),
            'create_tm' => Yii::t('shop', 'Create Tm'),
            'update_tm' => Yii::t('shop', 'Update Tm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleShopOptions()
    {
        return $this->hasMany(Options::className(), ['category_id' => 'id']);
    }
}
