<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Роли пользователей';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Добавить роль', ['create'], ['class' => 'btn btn-success btn-indent-margin']) ?>
    <?= Html::a('Добавить новый доступ', ['create-permission'], ['class' => 'btn btn-success btn-indent-margin']) ?>
</p>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th></th>
            <th>Имя роли</th>
            <th>Код</th>
            <th></th>
        </tr>

        <?php foreach ($roles as $role){ ?>
            <tr>
                <td width="16px">
                    <a href="<?= Url::to(['/rbac/roles/update', 'role' => $role->name ]) ?>"
                       title="Редактировать"
                       data-pjax="0"
                    >
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                </td>
                <td>
                    <?= $role->description ?>
                </td>
                <td> <?= $role->name ?></td>
                <td width="16px">
                    <?php if (!in_array($role->name,['admin', 'user', 'ban', 'unknown', 'no_pay'])){ ?>
                        <a href="<?= Url::to(['/rbac/roles/delete', 'role' => $role->name, 'back' => urlencode(Yii::$app->request->getUrl()) ]) ?>"
                           data-method="post"
                           data-confirm="Вы действительно хотите удалить роль?"
                        >
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>