<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\maskedinput\MaskedInput;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="row">

            <?= $form->field($model, 'last_name', ['options' => ['class' => 'col-md-4 form-height']])->textInput() ?>

            <?= $form->field($model, 'first_name', ['options' => ['class' => 'col-md-4 form-height']])->textInput() ?>

            <?= $form->field($model, 'middle_name', ['options' => ['class' => 'col-md-4 form-height']])->textInput() ?>

        </div>

        <div class="row">
            <?= $form->field($model, 'email', ['options' => ['class' => 'col-md-6 form-height']])->textInput() ?>

            <?= $form->field($model, 'phone', ['options' => ['class' => 'col-md-6 form-height']])->widget(MaskedInput::className(), [
                'mask' => '+7(999)999-9999',
            ]) ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'password', ['options' => ['class' => 'col-md-6 form-height']])->passwordInput() ?>

            <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'col-md-6 form-height']])->passwordInput() ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>

