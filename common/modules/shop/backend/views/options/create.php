<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Options */

$this->title = Yii::t('shop', 'Create Options');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
