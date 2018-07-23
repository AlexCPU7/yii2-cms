<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ADM</span><span class="logo-lg">Панель управления</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top navbar-adm-top" role="navigation">

        <a href="#" class="sidebar-toggle sidebar-toggle-adm" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <?= Html::a(
                        'Выйти',
                        ['/site/logout'],
                        ['data-method' => 'post', 'class' => 'btn-logout']
                    ) ?>
                </li>

            </ul>
        </div>
    </nav>
</header>
