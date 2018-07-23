<?php

namespace common\modules\shop\models;

use Yii;

/**
 * This is the model class for table "module_shop_item".
 *
 * @property int $id
 * @property int $category_id
 * @property int $active
 * @property string $title
 * @property string $price_rub
 * @property string $price_usd
 * @property string $price_eur
 * @property string $url
 * @property string $descr
 * @property int $sort
 * @property string $create_tm
 * @property string $update_tm
 *
 * @property Category $category
 * @property ItemImg[] $moduleShopItemImgs
 * @property ItemOptions[] $moduleShopItemOptions
 * @property ItemStickers[] $moduleShopItemStickers
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $options;

    public static function tableName()
    {
        return 'module_shop_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stickers_ids'], 'each', 'rule' => ['integer']],
            [['category_id', 'title'], 'required'],
            [['category_id', 'active', 'sort'], 'integer'],
            [['price_rub', 'price_usd', 'price_eur'], 'number'],
            [['descr'], 'string'],
            [['create_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['update_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['create_tm', 'update_tm'], 'safe'],
            [['title', 'url'], 'string', 'max' => 255],
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
            'active' => Yii::t('shop', 'Active'),
            'title' => Yii::t('shop', 'Title'),
            'price_rub' => Yii::t('shop', 'Price Rub'),
            'price_usd' => Yii::t('shop', 'Price Usd'),
            'price_eur' => Yii::t('shop', 'Price Eur'),
            'url' => Yii::t('shop', 'Url'),
            'descr' => Yii::t('shop', 'Descr'),
            'sort' => Yii::t('shop', 'Sort'),
            'stickers_ids' => Yii::t('shop', 'Stickers'),
            'create_tm' => Yii::t('shop', 'Create Tm'),
            'update_tm' => Yii::t('shop', 'Update Tm'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'stickers_ids' => 'stickers',
                ],
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $arrOptiobs = Yii::$app->request->post('Item')['options'];
        foreach ($arrOptiobs as $optionId => $optionRes){

            $optModel = ItemOptions::find()
                ->where(['item_id' => $this->id])
                ->andWhere(['options_id' => $optionId])
                ->all();

            if (!empty($optModel)){
                foreach ($optModel as $item){
                    //перечисляем всё возможный варианты опций
                    if (!($item->options_item_id == $optionRes)){
                        //если в бд не находится выбраный элемент
                        $delModel = ItemOptions::find()
                            ->where(['item_id' => $this->id])
                            ->andWhere(['options_id' => $optionId])
                            ->one();
                        if ($delModel) {
                            $delModel->delete(['item_id' => $this->id, 'options_id' => $optionId]);
                        }

                        $addNewAttr = new ItemOptions();
                        $addNewAttr->item_id = $this->id;
                        $addNewAttr->options_id = $optionId;
                        $addNewAttr->options_item_id = $optionRes;
                        if($addNewAttr->validate()){
                            $addNewAttr->save();
                        }
                    }
                }
            }else{
                $addNewAttr = new ItemOptions();
                $addNewAttr->item_id = $this->id;
                $addNewAttr->options_id = $optionId;
                $addNewAttr->options_item_id = $optionRes;
                if($addNewAttr->validate()){
                    $addNewAttr->save();
                }
            }
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
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
    public function getModuleShopItemImgs()
    {
        return $this->hasMany(ItemImg::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleShopItemOptions()
    {
        return $this->hasMany(ItemOptions::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleShopItemStickers()
    {
        return $this->hasMany(ItemStickers::className(), ['item_id' => 'id']);
    }

    public function getStickers(){
        return $this->hasMany(Stickers::className(), ['id' => 'stickers_id'])
            ->viaTable('module_shop_item_stickers', ['item_id' => 'id']);
    }
}