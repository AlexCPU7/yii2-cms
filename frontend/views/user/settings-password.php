<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widget\MenuSettingsPanel;

$this->title = 'Изменить пароль';
?>

<div class="row">
    <div class="col-sm-3 col-xl-12">
        <?= MenuSettingsPanel::widget() ?>
    </div>

    <div class="col-sm-9 col-xl-12">
        <?php $formPas = ActiveForm::begin([
            'action' => 'update-password'
        ]); ?>

        <h2><?= Html::encode($this->title) ?>:</h2>

        <?= $formPas->field($updatePas, 'password', ['options' => ['class' => 'form-height']])->passwordInput() ?>

        <?= $formPas->field($updatePas, 'password_repeat', ['options' => ['class' => 'form-height']])->passwordInput() ?>

        <?= $formPas->field($updatePas, 'password_new', ['options' => ['class' => 'form-height']])->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>