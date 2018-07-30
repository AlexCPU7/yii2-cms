<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\content\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#panel1">Контент</a></li>
        <li><a data-toggle="tab" href="#panel2">Анонс</a></li>
    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active">
            <div class="nav-tabs-indent">
                <?= $form->field($model, 'active')->checkbox() ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div id="panel2" class="tab-pane fade">
            <div class="nav-tabs-indent">
                <?= $form->field($model, 'title_anons')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'sub_title_anons')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'img_anons')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'descr_anons')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'link_anons')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('content', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
