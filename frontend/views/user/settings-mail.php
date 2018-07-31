<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Notice;
use common\components\maskedinput\MaskedInput;
use yii\helpers\Url;
use frontend\widget\MenuSettingsPanel;

$this->title = 'Уведомления по почте';
?>

<div class="row">
    <div class="col-sm-3 col-xl-12">
        <?= MenuSettingsPanel::widget() ?>
    </div>

    <div class="col-sm-9 col-xl-12">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (is_null($notice)){ ?>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'tagsArray')->checkboxList($notice)->label(false) ?>
            <br>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <?php }else{ ?>
            <p>Почтовых уведомлений нет</p>
        <?php } ?>
    </div>

</div>
