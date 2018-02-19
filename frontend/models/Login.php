<?php
namespace app\models;

use yii\base\Model;

class Login extends Model {

    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['password', 'validatePassword']
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function validatePassword($attribute, $params){
        if(!$this->hasErrors()) {    //проверка на ошибки
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Логин или пароль введены неверно');
            }
        }
    }

    public function getUser(){
        return User::findOne(['login' => $this->login]);
    }

}