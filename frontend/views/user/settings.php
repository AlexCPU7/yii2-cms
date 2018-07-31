<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Notice;
use common\components\maskedinput\MaskedInput;
use yii\helpers\Url;
use frontend\widget\MenuSettingsPanel;

$this->title = 'Настройки';
?>

<div class="row">
    <div class="col-sm-3 col-xl-12">
        <?= MenuSettingsPanel::widget() ?>
    </div>

    <div class="col-sm-9 col-xl-12">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?php if (isset($avatar->avatar)){ ?>
            <?= Html::label('Текущая картинка'); ?>
            <div class="form-update-pic">
                <?= Html::img($avatar->avatar); ?>
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

        <br>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
