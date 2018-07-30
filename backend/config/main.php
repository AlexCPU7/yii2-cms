<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'rbac' => [
            'class' => 'backend\modules\rbac\Module',
        ],
        'content' => [
            'class' => 'common\modules\content\backend\Module',
        ],
    ],
    'homeUrl' => '/admin',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                ],
                'shop' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/modules/shop/translations',
                ],
                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/rbac/messages',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            /*'csrfCookie' => [
                'httpOnly' => true,
                'path' => '/admin',
            ],*/
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                //'path' => '/admin',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'cookieParams' => [
                'path' => '/admin',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'content/item/<url>' => 'content/item/list',
                'content/item/<url>/create' => 'content/item/create',
                'content/item/update/<url>/<id>' => 'content/item/update',
                'content/item/delete/<url>/<id>' => 'content/item/delete',

                //'content/item/<url>/<id>' => 'content/item/one'
            ],
        ],
    ],
    'params' => $params,
];
