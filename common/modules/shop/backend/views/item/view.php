<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\modules\shop\models\Category;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Item */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['category']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Items'), 'url' => Url::to(['index', 'catId' => $model->category_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <p>
        <?= Html::a(Yii::t('shop', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('shop', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('shop', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    $category = ArrayHelper::map(Category::find()->all(),'id', 'title');
                    return $category[$model->category_id];
                }
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function($model){
                    return $model->active ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>';
                }
            ],
            'title',
            'price_rub',
            'price_usd',
            'price_eur',
            'url',
            'descr:html',
            //'sort',
            'create_tm',
            'update_tm',
        ],
    ]) ?>

</div>
