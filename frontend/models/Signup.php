<?php
namespace app\models;

class Signup extends \yii\base\Model {

    public $username;
    public $login;
    public $password;
    public $email;
    public $date;

    public function rules(){
        ['username', 'login', 'password', 'email', 'date'];
        //5:58
    }

}