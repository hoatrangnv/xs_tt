<?php
    return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'xoso-me-console',
        'language'=>'vi',

        'preload'=>array('log'),

        'import'=>array(
            'application.models.*',        
            'application.components.*',
            'application.extensions.*', 
            'application.extensions.url.*',                 
            'application.utilities.*', 
            'zii.widgets.CPortlet',
        ),

        'modules' => array(
            'vesocp',
        ),
        'components'=>array(
            'user'=>array(            
                'allowAutoLogin'=>true,
            ),             

            'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=az24_veso',
                'emulatePrepare' => true,
                'username' => 'hDcVeSo',
                'password' => 'HdCVeSo@)!!',
                'charset' => 'utf8',
                'class'=>'CDbConnection',

            ),
            'db_kedao'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=partner_2012_kedao',
                'emulatePrepare' => true,
                'username' => 'prtHDCkedao',
                'password' => 'KEdao2012^&*(',
                'charset' => 'utf8',
                'class'=>'CDbConnection',

            ),
            
            'db_daily'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=dailyveso_vn',
                'emulatePrepare' => true,
                'username' => 'dailyVeSo',
                'password' => 'VeSo!@#456',
                'charset' => 'utf8',
                'class'=>'CDbConnection',

            ),
            
            'errorHandler'=>array(            
                'errorAction'=>'home/error',
            ),
            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,            
                'caseSensitive' => true,
                'rules'=>array(                                

                    '/<page:\d+>'=>'home/index',

                    'wcp/<controller:\w+>/<action:\w+>'=>'wcp/<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

                ),
            ),
            'cache' => array (
                //'class'=>'system.caching.CFileCache',
                'class' => 'CMemCache',
                'servers'=>array(
                    array(
                        'host'=>'localhost',
                        'port'=>11211,
                        'weight'=>100,
                    ),
                ),
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                ),
            ),
        ),

        'params'=>require(dirname(__FILE__).'/params.php'),
    );
