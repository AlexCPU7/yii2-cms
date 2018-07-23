<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use common\modules\shop\models\Stickers;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach($optionsList as $item){; ?>
        <?= $form->field($model, 'options['. $item->id .']')
            ->dropDownList(ArrayHelper::map($item->optionsItems, 'id', 'title'), ['prompt' => ''])
            ->label($item->title) ?>
    <?php } ?>

    <div class="row">
        <?= $form->field($model, 'title', ['options' => ['class' => 'col-lg-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'active', ['options' => ['class' => 'col-lg-12']])->checkbox() ?>

        <?= $form->field($model, 'url', ['options' => ['class' => 'col-lg-12']])->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'price_rub', ['options' => ['class' => 'col-sm-4']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'price_usd', ['options' => ['class' => 'col-sm-4']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'price_eur', ['options' => ['class' => 'col-sm-4']])->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'stickers_ids')
        ->checkboxList(ArrayHelper::map(Stickers::find()->all(), 'id', 'title'), ['multiple' => true]) ?>

    <div class="row">
        <?= $form->field($model, 'descr', ['options' => ['class' => 'col-lg-12']])->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]); ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('shop', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
