<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    /*require __DIR__ . '/../../common/config/params-local.php',*/
    require __DIR__ . '/params.php'
    /*require __DIR__ . '/params-local.php'*/
);

return [
    'id' => 'admin-cheese',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-admin',
            'cookieValidationKey' => 'P-aWBgoKQoQcaXSnqKbd3quflFmW6SJo',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-admin', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'admin-cheese',
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
                '<action>' => 'site/<action>',
            ],
        ],

    ],
    'params' => $params,
];
