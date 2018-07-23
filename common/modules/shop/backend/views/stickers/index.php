<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\backend\models\StickersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('shop', 'Stickers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stickers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('shop', 'Create Stickers'), ['create'], ['class' => 'btn btn-success']) ?>
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

            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'options' => ['style' => 'width:35px'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
