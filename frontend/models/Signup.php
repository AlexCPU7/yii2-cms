<?php
namespace app\models;

use yii\base\Model;

class Signup extends Model {

    public $username;
    public $login;
    public $password_hash;
    public $email;
   // public $date;

    public function rules(){
        return [
            [['username', 'login', 'password_hash', 'email'], 'required'],
            ['email', 'email'],
            [['login', 'email'], 'unique', 'targetClass'=>'app\models\User'],
            ['password_hash', 'string', 'min'=>6, 'max'=>20]
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Имя',
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Электронная почта',
            //'date' => 'Дата',
        ];
    }

    public function signup() {
        $user = new User();
        $user->username = $this->username;
        $user->login = $this->login;
        $user->setPassword_hash($this->password_hash);
        $user->email = $this->email;
        $user->role = 2;
        return $user->save();

    }

}