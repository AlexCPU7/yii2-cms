<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\Category */

$this->title = Yii::t('shop', 'Update Option: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Options'), 'url' => Url::to(['edit', 'category' => $model->category_id])];
$this->params['breadcrumbs'][] = Yii::t('shop', 'Update');
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]); ?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'active_filter')->checkbox() ?>

    <div class="attribute-checkbox-form-update">

        <?php $form = ActiveForm::begin(); ?>

        <h3><?= Yii::t('shop', 'Elements'); ?></h3>

        <div class="row form-group">
            <?php foreach($groupList as $item){ ?>
                <div class="col-md-3 col-lg-3 form-group-input">
                    <input type="text" class="form-control input-group input-checkbox-radio" name="Group[<?= $item->id ?>][title]" value="<?= $item->title ?>">
                    <?= Html::a('', Url::to(['delete-item', 'id' => $item->id, 'attribute' => $model->id]), ['class' => 'glyphicon glyphicon-trash btn-del-group', 'data-confirm' => Yii::t('shop', 'Are you sure you want to delete the item?')]) ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            <?= Html::button('Добавить новый элемент', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <!-- modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php $formItem = ActiveForm::begin(); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Добавить новый элемент</h4>
                </div>
                <div class="modal-body modal-input-item">
                    <?= $formItem->field($addItem, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="modal-body modal-input-item">
                    <?php // $formItem->field($addItem, 'url')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php ActiveForm::end(); ?>

</div>

