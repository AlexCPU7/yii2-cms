<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('shop', 'Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <p>
        <?= Html::a(Yii::t('shop', 'Create Item'), Url::to(['create', 'catId' => $catId]), ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'headerOptions' => ['class' => 'text-center', 'style' => 'width:35px;'],
                'contentOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'id',
                'headerOptions' => ['class' => 'text-center', 'style' => 'width:70px;'],
                'contentOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($model){
                    return Html::a($model->title, Url::to(['view', 'id' => $model->id]));
                }
            ],


            [
                'attribute' => 'active',
                'filter' => [
                    1 => 'Да',
                    0 => 'Нет',
                ],
                'options' => ['style' => 'width:120px;'],
                'format' => 'html',
                'value' => function($model){
                    return $model->active ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>';
                }
            ],

            'price_rub',
            'price_usd',
            'price_eur',
            'url',
            //'descr:ntext',
            //'sort',
            'create_tm',
            'update_tm',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'options' => ['style' => 'width:35px'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    </div>

    <?php Pjax::end(); ?>
</div>
