<?php

namespace common\modules\shop\backend\controllers;

use common\modules\shop\models\Category;
use common\modules\shop\models\ItemOptions;
use common\modules\shop\models\Options;
use Yii;
use common\modules\shop\models\Item;
use common\modules\shop\backend\models\ItemSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\shop\backend\models\CategorySearch;
use yii\data\ActiveDataProvider;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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

    public function actionCategory()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('category', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex($catId)
    {
        //$searchModel = new ItemSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()->where(['category_id' => $catId]),
        ]);

        return $this->render('item', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catId' => $catId
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($catId = null)
    {
        $model = new Item();
        $model->category_id = $catId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $optionsList = Options::find()->where(['category_id' => $model->category_id])->joinWith('optionsItems')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'optionsList' => $optionsList
        ]);
    }

    /**
     * Deletes an existing Item model.
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

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            $model->update_tm = date("Y-m-d H:i:s");
            $arrOptions = ItemOptions::find()->where(['item_id' => $model->id])->all();
            $newArrOptions = [];
            foreach ($arrOptions as $options){
                $newArrOptions[$options->options_id] = $options->options_item_id;
                //$newArrOptions[$options->options_id] = $oneArr;
            }
            $model->options = $newArrOptions;
            /*$model->options = [
                1=>1,
                2=>3,
                3=>4
            ];*/
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
