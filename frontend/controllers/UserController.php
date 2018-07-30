<?php
/**
 * Created by PhpStorm.
 * User: Dev
 * Date: 02.04.2018
 * Time: 18:34
 */

namespace frontend\controllers;

use frontend\components\controllers\DefaultFrontendController;
use common\models\UserAvatar;
use frontend\models\UpdatePassword;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Yii;
use common\models\UserModel;

class UserController extends DefaultFrontendController{

    const file_name_length = 8;

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['unknown', 'no_pay', 'user', 'admin']
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['site/login']);
                }
            ],
        ];
    }

    public function actionProfile(){

        $user = UserModel::findOne(Yii::$app->user->id);
        $userAvatar = UserAvatar::findOne(Yii::$app->user->id);

        return $this->render('profile', [
            'user' => $user,
            'userAvatar' => $userAvatar
        ]);
    }

    public function actionSettings(){

        $model = $this->findModel(Yii::$app->user->id);
        $updatePas = new UpdatePassword();

        $avatar = UserAvatar::findOne(['user_id' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($_FILES['UserModel']['name']['imageFile']) {
                $user_avatar = UserAvatar::findOne(['user_id' => Yii::$app->user->id]);
                if ($user_avatar == null) {
                    $user_avatar = new UserAvatar();
                    $user_avatar->user_id = Yii::$app->user->id;
                } else {
                    unlink(Yii::getAlias('@frontend/web' . $user_avatar->avatar));
                    rmdir('uploads/users/' . Yii::$app->user->id);
                }

                mkdir('uploads/users/' . Yii::$app->user->id);

                $user_avatar->imageFile = UploadedFile::getInstance($model, 'imageFile');

                $fileNameImg = 'uploads/users/' . Yii::$app->user->id . '/' .Yii::$app->security->generateRandomString(self::file_name_length) . '.' . $user_avatar->imageFile->getExtension();
                $user_avatar->avatar = '/' . $fileNameImg;

                $user_avatar->imageFile->saveAs($fileNameImg);

                $user_avatar->save();
            }

            return $this->redirect('profile');
        }

        return $this->render('settings', [
            'model' => $model,
            'avatar' => $avatar,
            'updatePas' => $updatePas
        ]);
    }

    public function actionSettingsPassword(){
        /* ДЕЛАТЬ */
        return $this->render('settings-password');
    }

    /**
     * Изменить пароль
     */
    public function actionUpdatePassword(){
        $id = Yii::$app->user->id;
        $user = $this->findModel($id);
        if($user->updatePassword($id)){
            Yii::$app->session->setFlash('success', 'Пароль успешно был изменён.');
            return $this->redirect('profile');
        }else{
            Yii::$app->session->setFlash('error','Пароль не был изменён, вы ввели неправильный пароль.');
            return $this->redirect('settings');
        }
    }

    protected function findModel($id)
    {
        if (($model = UserModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}