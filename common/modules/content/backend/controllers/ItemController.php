<?php

namespace common\modules\content\backend\controllers;

use common\components\Img;
use common\modules\content\models\ContentType;
use Yii;
use common\modules\content\models\Content;
use common\modules\content\backend\models\ContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\FileHelper;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ItemController extends Controller
{
    const file_name_length = 8;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionList($url)
    {
        $contentType = $this->findContentType($url);
        $searchModel = new ContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $contentType);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'contentType' => $contentType
        ]);
    }

    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($url)
    {
        $contentType = $this->findContentType($url);
        $model = new Content();
        $model->type_id = $contentType->id;
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/content/item/' . $url]);
        }

        return $this->render('create', [
            'model' => $model,
            'contentType' => $contentType
        ]);
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($url, $id)
    {
        $model = $this->findModel($id);
        $contentType = $this->findContentType($url);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $img = new Img();
            $path = '/uploads/content/';

            $attribute = 'img';
            $img->Save($model, $path, $attribute);

            $attribute = 'img_anons';
            $img->Save($model, $path, $attribute);

            return $this->redirect(['/content/item/' . $url]);
        }

        return $this->render('update', [
            'model' => $model,
            'contentType' => $contentType
        ]);
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($url, $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/content/item/' . $url]);
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            $model->update_tm = date("Y-m-d H:i:s");
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('content', 'The requested page does not exist.'));
    }

    protected function findContentType($url)
    {
        if (($model = ContentType::find()->where(['url' => $url])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('content', 'The requested page does not exist.'));
    }
}
