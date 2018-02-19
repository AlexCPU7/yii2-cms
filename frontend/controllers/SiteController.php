<?php
namespace frontend\controllers;

use app\models\Signup;
use app\models\login;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){

        return $this->render('index');
    }

    public function actionSignup(){

        $this->checkUser();

        $model = new Signup();

        if (isset($_POST['Signup'])){
            //var_dump($_POST['Signup']);die;
            $model->attributes = Yii::$app->request->post('Signup');

            //проверка правил валидации и запись пользователя в бд
            if ($model->validate() && $model->signup()){
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model
        ]);
    }

    public function actionLogin(){

        $this->checkUser();

        $login_model = new Login();

        if (Yii::$app->request->post('Login')){
            $login_model->attributes = Yii::$app->request->post('Login');

            //проеверка валидации
            if ($login_model->validate()){
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login', [
            'login_model' => $login_model
        ]);
    }

    public function actionLogout(){
        if(!Yii::$app->user->isGuest){
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    public function checkUser(){
        if(!Yii::$app->user->isGuest){
            $this->goHome();
        }
    }
}
