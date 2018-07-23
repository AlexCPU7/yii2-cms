<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Equipment */

$this->title = Yii::t('shop', 'Create Equipment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Equipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="equipment-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'item_id')->dropDownList($model->getListItem(), ['multiple' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('shop', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
