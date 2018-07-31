<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\content\backend\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $contentType common\modules\content\backend\controllers\ItemController */

$this->title = $contentType->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <p>
        <?= Html::a(Yii::t('content', 'Create Content'), ['/content/item/' . $contentType->url . '/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'urlCreator'=>function($action, $model){
                    return ['/content/item/update/' . $_GET['url'] . '/' . $model->id];
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

            //'sub_title',
            //'img',
            //'descr:ntext',
            //'link',
            //'title_anons',
            //'sub_title_anons',
            //'img_anons',
            //'descr_anons:ntext',
            //'link_anons',
            'create_tm',
            'update_tm',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'urlCreator'=>function($action, $model){
                    return ['/content/item/delete/' . $_GET['url'] . '/' . $model->id];
                },
                'options' => ['style' => 'width:35px'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
