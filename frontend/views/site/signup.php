<h2>Регистрация</h2>
<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['class' => 'form-horizontsl' ]); ?>

<?= $form->field($model, 'username')->textInput()->label('Имя'); ?>

<?= $form->field($model, 'login')->textInput(); ?>

<?= $form->field($model, 'password')->passwordInput(); ?>

<?= $form->field($model, 'email')->textInput(); ?>

<?= $form->field($model, 'date')->textInput(); ?>

<diev>
    <button type="submit" class="btn btn-primary">регистрация</button>
</diev>

<?php ActiveForm::end(); ?>
