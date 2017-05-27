<?php   
    //error_reporting(0);
    
    if(isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST']=='www.xoso.me'))
    {
        $path_cur=isset($_SERVER['REQUEST_URI'])? $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']:'xoso.me';
        $path_cur=str_replace($_SERVER['HTTP_HOST'],'xoso.me',$path_cur);    
        Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://".$path_cur ); 
    }


    @session_start();
    $yii=dirname(__FILE__).'/framework/yii.php';
    if(isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST']=='xoso.me')){
        $config=dirname(__FILE__).'/protected/config_live/main.php';
    }else{
        $config=dirname(__FILE__).'/protected/config/main.php';
    }
    
    

    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

    require_once($yii);
    //require_once('libraryLogin.php');   

    Yii::createWebApplication($config)->run();
