<?php                                                   
/*if(isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST']=='www.ketquaveso.com'))
{
    $path_cur=isset($_SERVER['REQUEST_URI'])? $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']:'ketquaveso.com';
    $path_cur=str_replace($_SERVER['HTTP_HOST'],'ketquaveso.com',$path_cur);    
    Header( "HTTP/1.1 301 Moved Permanently" );
    Header( "Location: http://".$path_cur ); 
}
       */
session_start();
error_reporting(0);
$yii=dirname(__FILE__).'/framework/yii.php';    
$config=dirname(__FILE__).'/protected/config/main.php';
 
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);
//require_once('libraryLogin.php');   

Yii::createWebApplication($config)->run();     
