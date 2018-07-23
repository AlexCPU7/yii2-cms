<?php

namespace common\modules\shop\backend\controllers;

use Yii;
use common\modules\shop\models\EquipmentType;
use common\modules\shop\backend\models\EquipmentTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\shop\models\Equipment;

/**
 * EquipmentTypeController implements the CRUD actions for EquipmentType model.
 */
class EquipmentTypeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['canAdmin'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all EquipmentType models.
     * @return mixed
     */
    public function actionIndex($category)
    {
        $searchModel = new EquipmentTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    /**
     * Creates a new EquipmentType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EquipmentType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EquipmentType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EquipmentType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionItems($category, $type)
    {
        $model = $this->findEquipment($category, $type);

        /* НЕПОНЯТКИ !!! */

        if (empty($model)){
            $model = new Equipment();
            $model->category_id = $category;
            $model->type_id = $type;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('items', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the EquipmentType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EquipmentType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EquipmentType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('shop', 'The requested page does not exist.'));
    }

    protected function findEquipment($category, $type)
    {
        $model = Equipment::find()
            ->where(['category_id' => $category])
            ->andWhere(['type_id' => $type])
            ->all();

        return $model;
    }

}
