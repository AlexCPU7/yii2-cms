<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $login
 * @property string $password_hash
 * @property string $email
 * @property integer $role
 *
 * @property Roles $role0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'login', 'password_hash', 'email'], 'required'],
            [['role'], 'integer'],
            [['username', 'login', 'password_hash', 'email'], 'string', 'max' => 100],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'login' => 'Login',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'role' => 'Role',
        ];
    }

    public function setPassword_hash($password_hash){
        $this->password_hash = sha1($password_hash);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role']);
    }
}
