<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $middle_name;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'middle_name', 'phone', 'email', 'password', 'password_repeat'], 'required'],
            [['first_name', 'last_name', 'middle_name', 'phone', 'password_repeat', 'email', 'first_name', 'last_name', 'middle_name', 'phone'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким email уже зарегистрирован.'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message'=>'Введенные пароли не совпадают.'],
            [['password'], 'compare', 'compareAttribute' => 'password_repeat', 'message'=>'Введенные пароли не совпадают.']

        ];
    }

    public function attributeLabels() {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'password_hash' => 'Пароль',
            'password' => 'Пароль',
            'password_repeat' => 'Повторный пароль',
            'email' => 'Электронная почта',
            'phone' => 'Контактный телефон',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->middle_name = $this->middle_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if($user->save()){
            $user_role = Yii::$app->authManager->getRole('user');
            Yii::$app->authManager->assign($user_role, $user->id);
            $contentMas = [
                'first_name' => $this->first_name,
            ];
            Yii::$app->email->regUser($this->email, $contentMas);
            return $user;
        }else{
            return null;
        }
    }

    public function phone($phone){
        $vowels = ['+', '(', ')', '-'];
        $res = str_replace($vowels, "", $phone);
        return $res;
    }
}
