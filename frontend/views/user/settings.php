<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Notice;
use common\components\maskedinput\MaskedInput;
use yii\helpers\Url;

$this->title = 'Настройки';
?>

<div class="row">
    <div class="col-sm-3 col-xl-12">
        <div class="menu-settings">
            <ul class="menu-settings-ul">
                <li><a class="menu-settings-item" href="<?= Url::to(['settings']) ?>"><span>Профиль</span></a></li>
                <li><a class="menu-settings-item" href="<?= Url::to(['settings-password']) ?>"><span>Смена пароля</span></a></li>
                <li><a class="menu-settings-item" href="<?= Url::to(['settings-mail']) ?>"><span>Уведомления по почте</span></a></li>
            </ul>
        </div>
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

        <h2>Уведомления по почте:</h2>

        <?= $form->field($model, 'tagsArray')->checkboxList(
            Notice::find()->select(['title', 'id'])->indexBy('id')->column()
        )->label(false) ?>

        <br>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
