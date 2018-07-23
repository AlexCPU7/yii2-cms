<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\backend\models\EquipmentTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['/shop/category']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Options'), 'url' => ['/shop/category/edit', 'category' => $category]];
$this->title = Yii::t('shop', 'Equipment Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('shop', 'Create Equipment Type'), ['create'], ['class' => 'btn btn-success']) ?>
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
                    return Html::a($model->title, Url::to(['items', 'category' => $_GET['category'], 'type' => $model->id]));
                }
            ],

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
