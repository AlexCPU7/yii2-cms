<h2>Вход</h2>
<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['class' => 'form-horizontsl' ]); ?>

<?= $form->field($login_model, 'login')->textInput(); ?>

<?= $form->field($login_model, 'password')->passwordInput(); ?>

<diev>
    <button type="submit" class="btn btn-primary">вход</button>
</diev>

<?php ActiveForm::end(); ?>
