<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'active_filter')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('shop', 'Create an option and add items'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
