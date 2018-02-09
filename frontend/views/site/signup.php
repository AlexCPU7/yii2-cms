<h2>Регистрация</h2>
<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['class' => 'form-horizontsl' ]); ?>

<?= $form->field($model, 'username')->textInput(); ?>

<?= $form->field($model, 'login')->textInput(); ?>

<?= $form->field($model, 'password_hash')->passwordInput(); ?>

<?= $form->field($model, 'email')->textInput(); ?>

<diev>
    <button type="submit" class="btn btn-primary">регистрация</button>
</diev>

<?php ActiveForm::end(); ?>
