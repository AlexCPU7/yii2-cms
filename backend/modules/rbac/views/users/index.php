<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rbac\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],

            'user_id',

            [
                'attribute' => 'first_name',
                'value' => function ($data) {
                    if (isset($data->users->first_name)){
                        $name = $data->users->first_name;
                    }else{
                        $name = '-';
                    }


                    return Html::a(Html::encode($name), Url::to(['/users/view', 'id' => isset($data->users->id)?$data->users->id:'-']));
                },
                'format' => 'raw'
            ],

            'item_name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
    </div>

</div>
