<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Notice;
use common\components\maskedinput\MaskedInput;

$this->title = 'Настройки';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="settings-block-1">
    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="col-lg-12">

            <h2>Общая информация:</h2>

            <?php if (isset($avatar->avatar)){ ?>
                <?= Html::label('Текущая картинка') ?>
                <div class="form-update-pic">
                    <?= Html::img($avatar->avatar) ?>
                </div>
            <?php } ?>

            <?= $form->field($model, 'imageFile')->fileInput()?>

            <?= $form->field($model, 'last_name', ['options' => ['class' => 'form-height']])->textInput() ?>

            <?= $form->field($model, 'first_name', ['options' => ['class' => 'form-height']])->textInput() ?>

            <?= $form->field($model, 'middle_name', ['options' => ['class' => 'form-height']])->textInput() ?>

            <?= $form->field($model, 'email', ['options' => ['class' => 'form-height']])->textInput() ?>

            <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                'mask' => '+7(999)999-9999',
            ]) ?>

            <h2>Уведомления по почте:</h2>

            <?= $form->field($model, 'tagsArray')->checkboxList(
                Notice::find()->select(['title', 'id'])->indexBy('id')->column()
            )->label(false) ?>

            <br>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="settings-block-2">
    <div class="row">
        <?php $formPas = ActiveForm::begin([
            'action' => 'update-password'
        ]); ?>

        <div class="col-lg-12">

            <h2>Изменить пароль:</h2>

            <?= $formPas->field($updatePas, 'password', ['options' => ['class' => 'form-height']])->passwordInput() ?>

            <?= $formPas->field($updatePas, 'password_repeat', ['options' => ['class' => 'form-height']])->passwordInput() ?>

            <?= $formPas->field($updatePas, 'password_new', ['options' => ['class' => 'form-height']])->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
