<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>

<div class="user-moder">
    <div class="user-moder-avatar">
        <img src="/img/other/default-avatar.png" />
    </div>
    <div class="user-moder-name">
        <div class="user-moder-fio"><a href="<?= Url::toRoute(['view', 'id' => $model->id]) ?>" target="_blank"><?= $model->last_name . ' ' . $model->first_name  . ' ' . $model->middle_name ?></a></div>
    </div>
    <div class="user-moder-email-phone">
        <div class="user-moder-email">
            <?= $model->email ?>
        </div>
        <div class="user-moder-phone">
            <?= $model->phone ?>
        </div>
    </div>
    <div class="user-moder-btn">
        <?php
        Pjax::begin();
            $form = ActiveForm::begin([
                'options' => ['data' => ['pjax' => true]],
            ]);

                echo $form->field($model, 'user_id')->hiddenInput(['value' => $model->id])->label(false);
                echo $form->field($model, 'good_user')->hiddenInput(['value' => true])->label(false);

                echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success'], ['/admin/users/users-moder']);

            ActiveForm::end();
        ?>

        <?php
            $form = ActiveForm::begin([
                    'options' => ['data' => ['pjax' => true]],
                ]);

                echo $form->field($model, 'user_id')->hiddenInput(['value' => $model->id])->label(false);
                echo $form->field($model, 'ban_user')->hiddenInput(['value' => true])->label(false);

                echo Html::submitButton('Заблокировать', ['class' => 'btn btn-danger'], ['/admin/users/users-moder']);
            ActiveForm::end();
        Pjax::end();
        ?>

    </div>
</div>