<?php
    error_reporting(E_ALL & ~E_DEPRECATED);
    $yii = dirname(__FILE__).'/framework/yii.php';
    $config=dirname(__FILE__).'/protected/config_live/console.php';
    defined('YII_DEBUG') or define('YII_DEBUG',true);
     
    require_once($yii);
    Yii::createConsoleApplication($config)->run();
?>