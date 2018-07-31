<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\modules\content\models\Content */
/* @var $contentType common\modules\content\backend\controllers\ItemController */

$this->title = Yii::t('content', 'Update: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => $contentType->title , 'url' => ['/content/item/' . $contentType->url]];
$this->params['breadcrumbs'][] = Yii::t('content', 'Update');
?>
<div class="content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
