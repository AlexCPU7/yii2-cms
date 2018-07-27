<?php

namespace common\modules\content\models;

use Yii;

/**
 * This is the model class for table "module_content_type".
 *
 * @property int $id
 * @property int $active
 * @property string $title
 * @property string $url
 * @property string $create_tm
 * @property string $update_tm
 *
 * @property Content[] $moduleContents
 */
class ContentType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_content_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['update_tm'], 'default', 'value'=> date("Y-m-d H:i:s")],
            [['url'], 'unique',
                'targetClass' => '\common\modules\content\models\ContentType',
                'message' => Yii::t('content', 'This name already exists.')
            ],
            [['title', 'url', 'create_tm', 'update_tm'], 'required'],
            [['active'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['create_tm', 'update_tm'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('content', 'ID'),
            'active' => Yii::t('content', 'Active'),
            'title' => Yii::t('content', 'Title'),
            'url' => Yii::t('content', 'Url'),
            'create_tm' => Yii::t('content', 'Create Tm'),
            'update_tm' => Yii::t('content', 'Update Tm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['type_id' => 'id']);
    }
}
