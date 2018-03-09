<?php
namespace console\controllers;

use yii\console\Controller;
use Yii;

class StartAuthenticationController extends Controller
{

    public function actionIndex() {

        /*$admin = Yii::$app->authManager->createRole('admin');
        $admin->description = 'Администратор';
        Yii::$app->authManager->add($admin);

        $content = Yii::$app->authManager->createRole('content');
        $content->description = 'Контент менеджер';
        Yii::$app->authManager->add($content);

        $user = Yii::$app->authManager->createRole('user');
        $user->description = 'Пользователь';
        Yii::$app->authManager->add($user);

        $ban = Yii::$app->authManager->createRole('ban');
        $ban->description = 'Заблокирован';
        Yii::$app->authManager->add($ban);*/
    }
}