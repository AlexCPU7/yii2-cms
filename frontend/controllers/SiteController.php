<?php
namespace frontend\controllers;

use app\models\Signup;
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
            var_dump($_POST['Signup']);die;
        }

        return $this->render('signup', [
            'model' => $model
        ]);
    }
}
