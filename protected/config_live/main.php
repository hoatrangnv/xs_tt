<?php

    return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'xosothantai-vn',

        // preloading 'log' component
        'preload'=>array('log'),

        // autoloading model and component classes
        'import'=>array(
            'application.models.*',
            'application.components.*',		
            'application.extensions.url.*',             
            'application.utilities.*',
            'zii.widgets.CPortlet',		
        ),
        'defaultController'=>'home',
        'modules' => array(
            'thantaicp',
        ),

        'components'=>array(			
            'user'=>array(            
                'allowAutoLogin'=>true,
            ),

            'CURL' =>array(
                'class' => 'application.extensions.curl.Curl'
            ),

            'urlManager'=>array(
                'urlFormat'=>'path',			
                'showScriptName'=>false,
                'rules'=>array(           
                    
                    ''=>'home/index',
                    'dien-toan.html'=>'home/dientoan',
                    'dien-toan-ngay-hom-qua.html'=>'home/lastDientoan',
                    'xsmb-mien-bac.html'=>'home/mienbac',
                    'xsmn-mien-nam.html'=>'home/miennam',
                    'xsmt-mien-trung.html'=>'home/mientrung',

                    'mien-bac-hom-qua.html'=>'home/lastMienbac',
                    'mien-nam-hom-qua.html'=>'home/lastMiennam',
                    'mien-trung-hom-qua.html'=>'home/lastMientrung',

                    '/<alias>-d<did:\d+>.html'=>'dreambook/detail',                
                    '/so-mo/bat-dau-bang-<first_word>/<page:\d+>.html'=>'dreambook/index',                
                    '/so-mo/bat-dau-bang-<first_word>.html'=>'dreambook/index',  
                    '/so-mo/tim-hieu-<tukhoa>/<page:\d+>.html'=>'dreambook/index',   
                    '/so-mo/tim-hieu-<tukhoa>.html'=>'dreambook/index',              
                    '/so-mo/<page:\d+>.html'=>'dreambook/index',   
                    '/so-mo.html'=>'dreambook/index',
                    '/so-mo'=>'dreambook/index',

                    '/kqxsmb-mien-bac-ngay-<ngay>-<thang>-<nam>.html'=>'result/kqMienbac',                   
                    '/kqxsmb-mien-bac/<page:\d+>.html'=>'result/kqMienbac',
                    '/kqxsmb-mien-bac.html'=>'result/kqMienbac',

                    '/kqxsmn-mien-nam-ngay-<ngay>-<thang>-<nam>.html'=>'result/kqMiennam',                    
                    '/kqxsmn-mien-nam/<page:\d+>.html'=>'result/kqMiennam',
                    '/kqxsmn-mien-nam.html'=>'result/kqMiennam',

                    '/kqxsmt-mien-trung-ngay-<ngay>-<thang>-<nam>.html'=>'result/kqMientrung',                    
                    '/kqxsmt-mien-trung/<page:\d+>.html'=>'result/kqMientrung',
                    '/kqxsmt-mien-trung.html'=>'result/kqMientrung',

                    '/ket-qua-dien-toan-ngay-<ngay>-<thang>-<nam>.html'=>'result/dientoan',
                    '/ket-qua-dien-toan.html'=>'result/dientoan',

                    '/mien-bac/xs<code>-<province_name>-ngay-<ngay>-<thang>-<nam>-p<province_id:\d+>.html'=>'result/mienbac',
                    '/mien-bac/xs<code>-<province_name>-p<province_id:\d+>/<page:\d+>.html'=>'result/mienbac',
                    '/mien-bac/xs<code>-<province_name>-p<province_id:\d+>.html'=>'result/mienbac',

                    '/mien-nam/xs<code>-<province_name>-ngay-<ngay>-<thang>-<nam>-p<province_id:\d+>.html'=>'result/miennam',
                    '/mien-nam/xs<code>-<province_name>-p<province_id:\d+>/<page:\d+>.html'=>'result/miennam',
                    '/mien-nam/xs<code>-<province_name>-p<province_id:\d+>.html'=>'result/miennam',

                    '/mien-trung/xs<code>-<province_name>-ngay-<ngay>-<thang>-<nam>-p<province_id:\d+>.html'=>'result/mientrung',
                    '/mien-trung/xs<code>-<province_name>-p<province_id:\d+>/<page:\d+>.html'=>'result/mientrung',
                    '/mien-trung/xs<code>-<province_name>-p<province_id:\d+>.html'=>'result/mientrung',

                    'thong-ke-chu-ky-loto-<province_name>-p<province_id:\d+>.html'=>'statistic/chukyLoto',
                    'thong-ke-chu-ky-loto-<region>.html'=>'statistic/chukyLoto',
                    'thong-ke-chu-ky-loto.html'=>'statistic/chukyLoto',

                    'thong-ke-loto-gan-<province_name>-p<province_id:\d+>.html'=>'statistic/lotoGan',
                    'thong-ke-loto-gan-<region>.html'=>'statistic/lotoGan',
                    'thong-ke-loto-gan.html'=>'statistic/lotoGan',

                    'thong-ke-tan-suat-loto-theo-bang-<province_name>-p<province_id:\d+>.html'=>'statistic/tansuatLoto',
                    'thong-ke-tan-suat-loto-theo-bang-<region>.html'=>'statistic/tansuatLoto',
                    'thong-ke-tan-suat-loto-theo-bang.html'=>'statistic/tansuatLoto',

                    'thong-ke-tan-so-nhip-loto-<region>.html'=>'statistic/tansoNhipLoto',
                    'thong-ke-tan-so-nhip-loto.html'=>'statistic/tansoNhipLoto',

                    'thong-ke-dau-duoi-loto-<region>.html'=>'statistic/dauduoiLoto',
                    'thong-ke-dau-duoi-loto.html'=>'statistic/dauduoiLoto',

                    'thong-ke-giai-dac-biet-<region>.html'=>'statistic/dacbiet',
                    'thong-ke-giai-dac-biet.html'=>'statistic/dacbiet',

                    'thong-ke-dau-duoi-dac-biet-<region>.html'=>'statistic/dauduoiDacbiet',
                    'thong-ke-dau-duoi-dac-biet.html'=>'statistic/dauduoiDacbiet',

                    'thong-ke-chu-ky-dac-biet-<region>.html'=>'statistic/chukyDacbiet',
                    'thong-ke-chu-ky-dac-biet.html'=>'statistic/chukyDacbiet',

                    'thong-ke-tan-suat-cap-loto-theo-bang-<region>.html'=>'statistic/tansuatCapLoto',
                    'thong-ke-tan-suat-cap-loto-theo-bang.html'=>'statistic/tansuatCapLoto',

                    'thong-ke-tan-suat-<region>.html'=>'statistic/tansuatBoso',
                    'thong-ke-tan-suat.html'=>'statistic/tansuatBoso',

                    'thong-ke-nhanh-<region>.html'=>'statistic/nhanh',
                    'thong-ke-nhanh.html'=>'statistic/nhanh',

                    'thong-ke-loto-xien-<region>.html'=>'statistic/chukyXien',
                    'thong-ke-loto-xien.html'=>'statistic/chukyXien',

                    'thong-ke-ngay-<region>.html'=>'statistic/day',
                    'thong-ke-ngay.html'=>'statistic/day',

                    'thong-ke-tong-hop-chu-ky-dac-biet-<region>.html'=>'statistic/tonghopDacbiet',
                    'thong-ke-tong-hop-chu-ky-dac-biet.html'=>'statistic/tonghopDacbiet',

                    'thong-ke-tong-hop-<region>.html'=>'statistic/tonghop',
                    'thong-ke-tong-hop.html'=>'statistic/tonghop',

                    'thong-ke-tong-<region>.html'=>'statistic/tongBoso',
                    'thong-ke-tong.html'=>'statistic/tongBoso',                               


                    '/lich-quay-ket-qua-xo-so.html'=>'home/calendar',
                    
                    '/in-ve-do.html'=>'print/index',
                    '/in-ve-do-mien-bac.html'=>'print/mienbac',
                    '/in-ve-do-mien-nam.html'=>'print/miennam',
                    '/in-ve-do-mien-trung.html'=>'print/mientrung',
                    
                    '/nhung-ket-qua/tinh-<province_id>/ngay-<ngay_quay>'=>'embed/code',
                    '/nhung-ket-qua/tinh-<province_id>'=>'embed/code',
                    '/nhung-ket-qua'=>'embed/code',
                    '/ma-nhung-ket-qua.html'=>'embed/index',
                    
                    
                    '/rss/xo-so-<alias>-p<province_id:\d+>.rss'=>'rss/detail',
                    '/rss/xo-so-<alias>.rss'=>'rss/region',
                    '/rss/index.html'=>'rss/index',
                    
                    '/sitemap.xml'=>'sitemap/index',
                    '/sitemap_ketqua.xml'=>'sitemap/result',
                    '/sitemap_thongke.xml'=>'sitemap/thongke',
                    '/sitemap_tintuc.xml'=>'sitemap/news',
                    '/sitemap_thang-<month:\d+>-nam-<year:\d+>.xml'=>'sitemap/month',
                    '/sitemap_thang.xml'=>'sitemap/month',
                    
                    '/tin-tuc/<alias>-n<news_id:\d+>.html'=>'news/detail',
                    '/tin-tuc/<page:\d+>.html'=>'news/index',
                    '/tin-tuc/'=>'news/index',

                    '/so-than-tai.html'=>'mobat/index',
                    '/lich_su-so-than-tai.html'=>'mobat/history',

                    '/soi-cau-loto.html'=>'soicau/index',
                    '/soi-cau-loto-p-<province:\d+>-b-<bien_do_ngay:\d+>.html'=>'soicau/index',
                    '/soi-cau-dac-biet.html'=>'soicau/dacbiet',
                    '/soi-cau-dac-biet-p-<province:\d+>-b-<bien_do_ngay:\d+>.html'=>'soicau/dacbiet',
                    '/soi-cau-hai-nhay.html'=>'soicau/hainhay',
                    '/soi-cau-hai-nhay-p-<province:\d+>-b-<bien_do_ngay:\d+>.html'=>'soicau/hainhay',
                    '/soi-cau-bach-thu.html'=>'soicau/bachthu',
                    '/soi-cau-bach-thu-p-<province:\d+>-b-<bien_do_ngay:\d+>.html'=>'soicau/bachthu',
                    '/buoc-cau-chi-tiet-b<boso:\d+>-c<cau_id:\d+>-r<region:\d+>-pn-<province_name>.html'=>'soicau/detail',

                    '/ket-qua-xo-so-than-tai.html'=>'kqthantai/index',



                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            'errorHandler'=>array(            
                'errorAction'=>'home/error',
            ),
            'cache' => array (
                'class'=>'system.caching.CFileCache',
                /*'class' => 'CMemCache',
                'servers'=>array(
                    array(
                        'host'=>'localhost',
                        'port'=>11211,
                        'weight'=>100,
                    ), 
                ), */
            ),

             'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=xosothantai',
                'emulatePrepare' => true,
                'username' => 'xosothantai',
                'password' => 'hF6CRVFmDUWH3P8n',
                'charset' => 'utf8',
                'class'=>'CDbConnection',

            ),
            

            'errorHandler'=>array(
                'errorAction'=>'home/error',
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
