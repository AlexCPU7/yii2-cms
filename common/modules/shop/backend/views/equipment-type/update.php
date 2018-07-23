<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\EquipmentType */

$this->title = Yii::t('shop', 'Update Equipment Type: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Equipment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('shop', 'Update');
?>
<div class="equipment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
