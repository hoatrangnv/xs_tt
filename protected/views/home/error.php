<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="vi" http-equiv="content-language" />
        <meta name="robots" content="noindex,nofollow " />
        <meta property="article:tag" content="kết quả xổ số, dự đoán" />
        <meta name="AUTHOR" content="xosothantai.vn" />
        <meta name="COPYRIGHT" content="Copyright (C) 2011 xosothantai.vn" />
        <meta name="RATING" content="GENERAL" />
        <meta name="revisit-after" content="1 days"/>
        <link rel='index' title='Kết quả xổ số' href='http://xosothantai.vn' />
        <title>Không tồn trang này - Error</title>
        <meta http-equiv="refresh" content="30; URL=<?php echo Url::createUrl("home/index")?>" />
        <link href="<?php echo Yii::app()->params["static_url"]?>/css/style.css?v=0.2" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="wrapper">
            <div class="main">
                <div class="box-404 txt-center">
                    <img src="<?php echo Yii::app()->params["static_url"]?>/images/ic-404.png" alt="page not found" class="mag-r15 in-block" />
                    <div class="in-block txt-left">
                        <div class="s24">
                            <?php 
                                if($error["code"]==405){
                                    echo $error["message"];
                                }else{
                                    echo ' Địa chỉ mà bạn vừa truy cập không tồn tại';
                                }
                            ?>
                        </div>
                        <p class="mag5-0">- Để quay về trang chủ bạn vui lòng ấn <a href="<?php echo Url::createUrl("home/index")?>" title="" class="clred"><strong>vào đây</strong></a></p>
                        <p class="mag5-0">- Hoặc hệ thống sẽ tự động quay về sau <strong>30 giây</strong></p>
                        <p class="mag5-0"><a href="<?php echo Url::createUrl("home/index")?>" title="" class="bt-green in-block">Về trang chủ</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
