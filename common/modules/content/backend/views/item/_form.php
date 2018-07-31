<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

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

                <?php if (!$model->isNewRecord){ ?>
                    <?= Html::label('Текущая картинка') ?>
                    <div class="form-update-pic">
                        <?= Html::img($model->img) ?>
                    </div>
                <?php } ?>

                <?= $form->field($model, 'img')->fileInput()?>

                <?= $form->field($model, 'descr')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ],
                ]); ?>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div id="panel2" class="tab-pane fade">
            <div class="nav-tabs-indent">
                <?= $form->field($model, 'title_anons')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'sub_title_anons')->textInput(['maxlength' => true]) ?>

                <?php if (!$model->isNewRecord){ ?>
                    <?= Html::label('Текущая картинка') ?>
                    <div class="form-update-pic">
                        <?= Html::img($model->img_anons) ?>
                    </div>
                <?php } ?>

                <?= $form->field($model, 'img_anons')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'descr')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ],
                ]); ?>

                <?= $form->field($model, 'link_anons')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('content', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
