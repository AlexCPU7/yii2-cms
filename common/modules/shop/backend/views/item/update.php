<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Item */

$this->title = Yii::t('shop', 'Update Item: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['category']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Items'), 'url' => Url::to(['index', 'catId' => $model->category_id])];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('shop', 'Update');
?>
<div class="item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
        'optionsList' => $optionsList
    ]) ?>

</div>
