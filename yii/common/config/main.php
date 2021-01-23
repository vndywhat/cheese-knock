<?php
return [
    'name' => 'Cheese-Knock',
    'language' => 'ru-Ru',
    'timeZone' => 'Asia/Omsk',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=pizza',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
			'enableSchemaCache' => true,

            // Продолжительность кеширования схемы.
            'schemaCacheDuration' => 3600,

            // Название компонента кеша, используемого для хранения информации о схеме
            'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'storage' => [
            'class' => 'backend\components\Storage',
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6LeUs78UAAAAAMozWGs7k3ozCHK8z5eLjLxq-4DT',
            'secretV2' => '6LeUs78UAAAAAN19Ou2jP2jsR6xWCFWB7y6aGd5O',
        ],
    ],
];
