<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\content\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'decsr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_anons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title_anons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img_anons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'decsr_anons')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_anons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_tm')->textInput() ?>

    <?= $form->field($model, 'update_tm')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('content', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
