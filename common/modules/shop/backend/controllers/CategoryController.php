<?php

namespace common\modules\shop\backend\controllers;

use common\modules\shop\models\Options;
use common\modules\shop\models\OptionsItem;
use Yii;
use common\modules\shop\models\Category;
use common\modules\shop\backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\modules\shop\backend\models\OptionsSearch;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
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
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateOpt($id)
    {
        $model = $this->findOptions($id);
        $groupList = $this->listOpt($id);
        $addItem = new OptionsItem();

        if (Yii::$app->request->post('Group')){

            foreach (Yii::$app->request->post('Group') as $idCheckbox => $title){
                $item = OptionsItem::findOne($idCheckbox);
                if ($item){
                    $item->title = $title['title'];
                    if ($item->validate()){
                        $item->save();
                    }
                }
            }
        }

        if (Yii::$app->request->post('OptionsItem')){
            $addItem->options_id = $id;
            if ($addItem->load(Yii::$app->request->post()) && $addItem->validate() && $addItem->save()) {
                return $this->redirect(['update-opt', 'id' => $id]);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update-opt', 'id' => $id]);
        }

        return $this->render('updateOpt', [
            'model' => $model,
            'groupList' => $groupList,
            'addItem' => $addItem
        ]);
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            $model->update_tm = date("Y-m-d H:i:s");
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('shop', 'The requested page does not exist.'));
    }

    /**
     * @param $category
     * @return string
     */
    public function actionEdit($category)
    {
        //$searchModel = new OptionsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Options::find()->where(['category_id' => $category]),
        ]);

        return $this->render('edit', [
            'category' => $category,
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateOpt($category)
    {
        $model = new Options();
        $model->category_id = $category;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update-opt', 'id' => $model->id]);
        }

        return $this->render('createOpt', [
            'model' => $model,
        ]);
    }

    protected function findOptions($id)
    {
        if (($model = Options::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('shop', 'The requested page does not exist.'));
    }

    protected function listOpt($id)
    {
        if (($model = OptionsItem::find()->where(['options_id' => $id])->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeleteOptions($id, $attribute)
    {
        $model = Options::findOne($id);
        if (isset($model)){
            $model->delete();
        }

        return $this->redirect(['edit', 'category' => $attribute]);
    }

    public function actionDeleteItem($id, $attribute)
    {
        $model = OptionsItem::findOne($id);
        if (isset($model)){
            $model->delete();
        }

        return $this->redirect(['update-opt', 'id' => $attribute]);
    }




}
