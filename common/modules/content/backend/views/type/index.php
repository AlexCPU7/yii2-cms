<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\content\backend\models\ContentTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content', 'Content Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <p>
        <?= Html::a(Yii::t('content', 'Create Content Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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

            'title',

            'url',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
