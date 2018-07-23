<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('shop', 'Options');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?php Pjax::begin(); ?>

    <div class="btn-group btn-indent-margin">
        <?= Html::a(Yii::t('shop', 'Create options'),  Url::to(['create-opt', 'category' => $category]), ['class' => 'btn btn-success']) ?>
    </div>

    <div class="btn-group btn-indent-margin">
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><?= Yii::t('shop', 'Extra options') ?><span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="<?= Url::toRoute(['/shop/equipment-type', 'category' => $category]) ?>"><?= Yii::t('shop', 'Add new type of equipment') ?></a></li>
            <li><a href="<?= Url::toRoute(['/shop/equipment', 'category' => $category]) ?>"><?= Yii::t('shop', 'Types of equipment') ?></a></li>
        </ul>
    </div>

    <div class="table-responsive">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'urlCreator'=>function($action, $model, $key, $index){
                    return ['update-opt','id'=>$model->id];
                },
                'headerOptions' => ['class' => 'text-center', 'style' => 'width:35px;'],
                'contentOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'id',
                'headerOptions' => ['class' => 'text-center', 'style' => 'width:70px;'],
                'contentOptions' => ['class' => 'text-center'],
            ],

            'title',

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
             [
                'attribute' => 'active_filter',
                'filter' => [
                    1 => 'Да',
                    0 => 'Нет',
                ],
                'options' => ['style' => 'width:200px;'],
                'format' => 'html',
                'value' => function($model){
                    return $model->active_filter ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>';
                }
            ],

            //'descr:ntext',
            //'order',
            //'create_tm',
            //'update_tm',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'urlCreator'=>function($action, $model, $key, $index){
                    return ['delete-options','id' => $model->id, 'attribute' => $model->category_id];
                },
                'options' => ['style' => 'width:35px'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    </div>

    <?php Pjax::end(); ?>
</div>
