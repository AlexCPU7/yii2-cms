<?php

namespace common\modules\content\models;

use Yii;
use common\models\UserModel as User;

/**
 * This is the model class for table "module_content".
 *
 * @property int $id
 * @property int $type_id
 * @property int $user_id
 * @property int $active
 * @property string $title
 * @property string $sub_title
 * @property string $img
 * @property string $descr
 * @property string $link
 * @property string $title_anons
 * @property string $sub_title_anons
 * @property string $img_anons
 * @property string $descr_anons
 * @property string $link_anons
 * @property string $create_tm
 * @property string $update_tm
 *
 * @property ContentType $type
 * @property User $user
 */
class Content extends \yii\db\ActiveRecord
{
    public $imgFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['update_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['type_id', 'user_id', 'create_tm', 'update_tm'], 'required'],
            [['type_id', 'user_id', 'active'], 'integer'],
            [['descr', 'descr_anons'], 'string'],
            [['create_tm', 'update_tm'], 'safe'],
            [['title', 'sub_title', 'img', 'link', 'title_anons', 'sub_title_anons', 'img_anons', 'link_anons'], 'string', 'max' => 255],
            //[['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContentType::className(), 'targetAttribute' => ['type_id' => 'id']],
            //[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('content', 'ID'),
            'type_id' => Yii::t('content', 'Type ID'),
            'user_id' => Yii::t('content', 'User ID'),
            'active' => Yii::t('content', 'Active'),
            'title' => Yii::t('content', 'Title'),
            'sub_title' => Yii::t('content', 'Sub Title'),
            'img' => Yii::t('content', 'Img'),
            'descr' => Yii::t('content', 'descr'),
            'link' => Yii::t('content', 'Link'),
            'title_anons' => Yii::t('content', 'Title Anons'),
            'sub_title_anons' => Yii::t('content', 'Sub Title Anons'),
            'img_anons' => Yii::t('content', 'Img Anons'),
            'descr_anons' => Yii::t('content', 'descr Anons'),
            'link_anons' => Yii::t('content', 'Link Anons'),
            'create_tm' => Yii::t('content', 'Create Tm'),
            'update_tm' => Yii::t('content', 'Update Tm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ContentType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
