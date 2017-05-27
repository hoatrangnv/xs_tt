<?php $version = '1.1';?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="vi" http-equiv="content-language" />
<title><?php echo isset($this->metaTitles) ? $this->metaTitles : Yii::app()->params["titles"] ?></title> 
<meta name="keywords" content="<?php echo isset($this->metaKeywords) ? $this->metaKeywords : Yii::app()->params["keywords"] ?>"/>
<meta name="description" content="<?php echo isset($this->metaDescription) ? $this->metaDescription : Yii::app()->params["descriptions"] ?>"/>
<?php if(!empty($this->prevLink)){?>
    <link rel="prev" href="<?php echo $this->prevLink;?>"/>
    <?php }?>
<?php if(!empty($this->linkCanoncical)){?>
    <link rel="canonical" href="<?php echo $this->linkCanoncical;?>" />
    <?php }?>   
<?php if(!empty($this->nextLink)){?>
    <link rel="next" href="<?php echo $this->nextLink;?>"/>
    <?php }?>
<?php 
    $index = !empty($this->noindex) && $this->noindex==1 ? 'noindex' : 'index';
    $follow = !empty($this->nofollow) && $this->nofollow==1 ? 'nofollow' : 'follow';
?>
<meta name="robots" content="<?php echo $index;?>,<?php echo $follow;?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo isset($this->metaTitles) ? $this->metaTitles : Yii::app()->params["titles"] ?>" />
<meta property="og:description" content="<?php echo isset($this->metaDescription) ? $this->metaDescription : Yii::app()->params["descriptions"] ?>" />
<meta content="<?php echo isset($this->metaKeywords) ? $this->metaKeywords : Yii::app()->params["keywords"] ?>" itemprop="keywords" name="keywords"/> 
<meta property="article:author" content="xosothantai.vn" />
<meta property="article:section" content="Lottery" />
<meta property="article:tag" content="kết quả xổ số, dự đoán" />
<meta name="AUTHOR" content="xosothantai.vn" />
<meta name="COPYRIGHT" content="Copyright (C) 2011 xosothantai.vn" />
<meta name="RATING" content="GENERAL" />
<meta name="revisit-after" content="1 days"/>
<meta property="fb:app_id" content="<?php echo Yii::app()->params["fb_app_id"]?>"/>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">


<link rel='index' title='Kết quả xổ số' href='http://xosothantai.vn' />
<?php
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;

?>


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url_cp"]?>/css/theme.css" media="all" />

<link href="<?php echo Yii::app()->params["static_url"] ?>/mobatcss/style.css" rel="stylesheet" type="text/css" /><link href="<?php echo Yii::app()->params["static_url"] ?>/mobatcss/Rep.css" rel="stylesheet" type="text/css" />


<link rel="shortcut icon" href="<?php echo Yii::app()->params["static_url"] ?>/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url"] ?>/css/style.css?v=<?php echo $version;?>" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url"] ?>/js/jquery-ui/jquery-ui.min.css?v=<?php echo $version;?>" />
<script src="<?php echo Yii::app()->params["static_url"] ?>/js/jquery.min.js?v=<?php echo $version;?>"></script>
<script src="<?php echo Yii::app()->params["static_url"] ?>/js/jquery.cookie.js?v=<?php echo $version;?>"></script>
<?php if(!in_array($control,array("bongda","dudoan","news","rss","search","sitemap","tuvi","video","xemtuong"))){?>
    <script src="<?php echo Yii::app()->params["static_url"] ?>/js/jquery-ui/jquery-ui-1.9.2.min.js?v=<?php echo $version;?>"></script>
    <?php }?>
<script  src="<?php echo Yii::app()->params["static_url"] ?>/js/functions.js?v=<?php echo $version;?>"></script>

<script type="text/javascript">           
    function shownav(){
        if(document.getElementById('nav-hozital').style.display=="block"){
            document.getElementById('nav-hozital').style.display='none';
        }
        else{
            document.getElementById('nav-hozital').style.display='block';
        }
    }
    function showmnc2(id_mnu2){
        if(document.getElementById(id_mnu2).style.display=="block"){
            document.getElementById(id_mnu2).style.display='none';
        }
        else{
            document.getElementById(id_mnu2).style.display='block';
        }
    }
</script>

<div id="fb-root"></div>