<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('shop', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

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
                'onclick' => 'window.location = "' . Url::to(['/shop/item', 'catId' => $model->id]) . '"',
                'style' => 'cursor:pointer'
            ];
        },
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['class' => 'text-center', 'style' => 'width:70px;'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            'title',
        ],
    ]); ?>
    </div>

    <?php Pjax::end(); ?>
</div>
