<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Item */

$this->title = Yii::t('shop', 'Create Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['category']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Items'), 'url' => Url::to(['index', 'catId' => $_GET['catId']])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
