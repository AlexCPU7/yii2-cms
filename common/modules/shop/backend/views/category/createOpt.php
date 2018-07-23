<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Options */


$this->title = Yii::t('shop', 'Create Options');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Options'), 'url' => Url::to(['edit', 'category' => $model->category_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

    <?= $this->render('_formOpt', [
        'model' => $model,
    ]) ?>

</div>
