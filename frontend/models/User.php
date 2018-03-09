<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $login
 * @property string $password_hash
 * @property string $email
 * @property integer $role
 * @property integer $status
 *
 * @property Roles $role0
 */
class User extends ActiveRecord implements IdentityInterface
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

    public function validatePassword($password){
        return $this->password_hash === sha1($password);
    }

    public function getRole0()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role']);
    }

    //=====================================
    public static function findIdentity($id){
        return self::findOne($id);
    }

    public function getId(){
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getAuthKey(){}

    public function validateAuthKey($authKey){}

}
