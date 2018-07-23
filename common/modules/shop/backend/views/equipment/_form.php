<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use common\modules\shop\models\EquipmentType;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList($model->getListType(), ['prompt' => 'Выберите тип оборудования...']) ?>

    <?= $form->field($model, 'item_id')->dropDownList($model->getListItem(), ['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('shop', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
