<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Stickers */

$this->title = Yii::t('shop', 'Update Stickers: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Stickers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('shop', 'Update');
?>
<div class="stickers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
