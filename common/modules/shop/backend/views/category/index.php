<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('shop', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('shop', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        /* по клику открывает объект */
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover-gray'
        ],
        'rowOptions' =>function($model){
            return [
                'onclick' => 'window.location = "' . Url::to(['edit', 'category' => $model->id]) . '"',
                'style' => 'cursor:pointer'
            ];
        },
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

            'title',

            'url',

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

            //'descr:ntext',
            //'order',
            //'create_tm',
            //'update_tm',

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
