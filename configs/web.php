<?php

Yii::setAlias('@basePath', __DIR__ . '/..');
Yii::setAlias('@webPath', 'http://' . $_SERVER['HTTP_HOST']);

$config = [
    'id' => 'tiba-api',
    'basePath' => __DIR__ . '/../',
    'defaultRoute' => 'index/index',
    'bootstrap' => ['log'],
    'language' => 'ru_RU',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=api',
            'username' => 'root',
            'password' => 'ngJxC3h8',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache'
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'enabled' => YII_DEBUG,
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/api.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'enabled' => !YII_DEBUG,
                    'levels' => ['error', 'warning']
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'enabled' => !YII_DEBUG,
                    'levels' => ['error', 'warning'],
                    'message' => [
                        'from' => ['no-replay@tiba.com'],
                        'to' => ['d.kotenko@i.ua'],
                        'subject' => 'TiBa API error'
                    ]
                ]
            ]
        ],
        'request' => [
            'cookieValidationKey' => 'cookieKey',
            'enableCsrfValidation' => false,
            'baseUrl' => '/'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'scriptUrl' => '/'
        ],
        'assetManager' => [
            'basePath' => '@basePath/assets',
            'baseUrl' => '@webPath/assets',
        ],
        'customerSession' => [
            'class' => 'app\components\CustomerSession'
        ],
        'tokenManager' => [
            'class' => 'app\components\TokenManager'
        ],
        'errorHandler' => [
            'errorAction' => 'index/error-handler' // located in \app\components\BaseController
        ]
    ]
];

return $config;
