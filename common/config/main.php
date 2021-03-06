<?php
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'i18n' => [
            'translations' => [
                'content' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/modules/content/translations',
                ],
                'eav' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@mirocow/eav/messages',
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'datetimeFormat' => 'd MMMM Y, в H:i'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'cache' => 'cache'
        ],
        'email' => [
            'class' => 'common\components\EmailComponent',
        ],
        'date' => [
            'class' => 'common\components\DateComponent',
        ],
        'cud' => [
            'class' => 'common\components\CudComponent',
        ],
    ],

];
