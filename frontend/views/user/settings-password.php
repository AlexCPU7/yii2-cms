<?php

?>

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