<?php
use \common\models\UserModel;
use yii\helpers\Url;
use backend\components\menu\Menu;

$user = UserModel::findOne(Yii::$app->user->id);

$menu = new Menu();
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Url::to('/img/adminPanel/yii2-cdn.png'); ?>" class="img-circle" alt="Yii2 Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->email ?></p>
                <a href="<?= Url::to('/') ?>" target="_blank" style="color: #d8d330"><?= 'http://' . $_SERVER['SERVER_NAME'] ?></a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],

                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                    [
                        'label' => 'Настройки сайта',
                        'icon' => 'fw fa-gears',
                        'url' => '#',
                        'visible' => $menu->menuSettingsSite(),
                        'items' => [
                            [
                                'label' => 'Общая информация',
                                'icon' => 'fw fa-file-o',
                                'url' => ['/info-site/index'],
                                'visible' => Yii::$app->user->can('info_site')
                            ],
                            [
                                'label' => 'Расшифроква доступов',
                                'icon' => 'fw fa-eye',
                                'url' => ['/rbac/permission'],
                                'visible' => Yii::$app->user->can('admin_menu_rbac_permission')
                            ],
                            [
                                'label' => 'Роли пользователей',
                                'icon' => 'fw  fa-key',
                                'url' => ['/rbac/roles'],
                                'visible' => Yii::$app->user->can('admin_menu_rbac_roles')
                            ],
                            [
                                'label' => 'Почтовые уведомления',
                                'icon' => 'fw fa-bullhorn',
                                'url' => ['/notice/index'],
                                'visible' => Yii::$app->user->can('settings_add_email_push')
                            ],
                            [
                                'label' => 'Пользователи',
                                'icon' => 'fw fa-user',
                                'url' => ['/rbac/users'],
                                'visible' => Yii::$app->user->can('admin_menu_rbac_users')
                            ],
                            [
                                'label' => 'Some tools',
                                'icon' => 'fw fa-bug',
                                'url' => '#',
                                'visible' => Yii::$app->user->can('can_some_tools'),
                                'items' => [
                                    [
                                        'label' => 'Gii',
                                        'icon' => 'file-code-o',
                                        'url' => ['/gii'],
                                    ],
                                    [
                                        'label' => 'Debug',
                                        'icon' => 'dashboard',
                                        'url' => ['/debug'],
                                    ],
                                ]
                            ],
                        ],
                    ],

                    [
                        'label' => 'Пользователи',
                        'icon' => 'fw fa-male',
                        'url' => '#',
                        'visible' => $menu->menuUsers(),
                        'items' => [
                            [
                                'label' => 'Клиенты',
                                'icon' => 'fw fa-user',
                                'url' => ['/users'],
                                'visible' => Yii::$app->user->can('users_clients')
                            ],
                        ],
                    ],

                    [
                        'label' => 'Контент',
                        'icon' => 'fw fa-list-alt',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Виды контента',
                                'icon' => 'fw fa-clone',
                                'url' => ['/content'],
                            ],

                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
