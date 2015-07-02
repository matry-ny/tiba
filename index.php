<?php

// set project mode
define('MODE', 'dev');

defined('YII_DEBUG') or define('YII_DEBUG', MODE === 'dev');
defined('YII_ENV') or define('YII_ENV', MODE);

if (YII_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require_once __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$webConfig = require_once(__DIR__ . '/configs/web.php');
$localConfig = file_exists(__DIR__ . '/configs/local.php') ? require_once __DIR__ . '/configs/local.php' : [];
$config =  yii\helpers\ArrayHelper::merge($webConfig, $localConfig);

$app = (new yii\web\Application($config))->run();
