<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Equipment */

$this->title = Yii::t('shop', 'Create Equipment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Equipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
