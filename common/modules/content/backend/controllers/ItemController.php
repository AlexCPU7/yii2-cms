<?php

namespace common\modules\content\backend\controllers;

use common\modules\content\models\ContentType;
use Yii;
use common\modules\content\models\Content;
use common\modules\content\backend\models\ContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ItemController extends Controller
{
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

    /**
     * Lists all Content models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new ContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

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


    /*public function actionOne($url, $id)
    {
        return $url;
    }*/

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/content/item/' . $url]);
        }

        return $this->render('update', [
            'model' => $model,
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
