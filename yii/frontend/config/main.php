<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    /*require __DIR__ . '/../../common/config/params-local.php',*/
    require __DIR__ . '/params.php'
    /*require __DIR__ . '/params-local.php'*/
);

return [
    'id' => 'cheese-knock',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-cheese',
            'cookieValidationKey' => 'Qs6HwJq8zAA_0yM_kG-I3A5nrmGC3SxH',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-cheese', 'httpOnly' => true],
        ],
        'cart' => [
            'class' => 'frontend\components\cart\Cart',
            'storageClass' => 'frontend\components\cart\storage\SessionStorage',
            'calculatorClass' => 'frontend\components\cart\calculators\SimpleCalculator',
            'params' => [
                'key' => 'cart',
                'expire' => 604800,
                'productClass' => 'common\models\Product',
                'productFieldId' => 'id',
                'productFieldPrice' => 'price',
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'cheese-knock',
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
                '' => 'site/index',
                'shop' => 'category/all',
                'checkout' => 'cart/checkout',
                'checkout/<hash:[a-z0-9]+>' => 'cart/success',
                'category/<slug:[a-z0-9_\-]+>' => 'category/view',
                'product/<slug:[a-z0-9_\-]+>' => 'product/view',
                'cart' => 'cart/index',
                '<action>' => 'site/<action>',
                '<controller>' => '<controller>/index',
            ],
        ],

    ],
    'params' => $params,
];
