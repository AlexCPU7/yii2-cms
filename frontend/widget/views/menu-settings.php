<?php
use yii\helpers\Url;
?>

<div class="menu-settings">
    <ul class="menu-settings-ul">
        <li class="menu-settings-not-bor"><a class="menu-settings-item" href="<?= Url::to(['settings']) ?>"><span>Настройки</span></a></li>
        <li><a class="menu-settings-item" href="<?= Url::to(['settings-password']) ?>"><span>Смена пароля</span></a></li>
        <li><a class="menu-settings-item" href="<?= Url::to(['settings-mail']) ?>"><span>Уведомления по почте</span></a></li>
    </ul>
</div>