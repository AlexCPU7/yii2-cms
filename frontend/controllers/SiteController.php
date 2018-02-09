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
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionSignup(){
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
        $login_model = new Login();
        return $this->render('login', [
            'login_model' => $login_model
        ]);
    }
}
