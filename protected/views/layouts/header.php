<<<<<<< .mine
<?php
    $detect = new MobileDetect();
    if($detect->isiOS()){
        $link_down = "https://itunes.apple.com/us/app/xoso/id828154474?ls=1&mt=8";
    }else{
        $link_down = "https://play.google.com/store/apps/details?id=com.hdc.tructiepxoso";
    }
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $label_header = array(
        '<p>Nhận <strong>KQXS miền bắc siêu tốc</strong></p><p>Soạn: <strong class="cl-yll s16">XSMB gửi 19008612</strong></p>',
        '<p>Nhận <strong>KQXS miền nam siêu tốc</strong></p><p>Soạn: <strong class="cl-yll s16">XSMN gửi 19008612</strong></p>',
        '<p>Nhận <strong>KQXS miền trung siêu tốc</strong></p><p>Soạn: <strong class="cl-yll s16">XSMT gửi 19008612</strong></p>',
    );
    $date = getdate(time());
    $day = Common::getWeekDay($date["wday"]);
    $thu = "thu".$day["id"];
    $data = Provinces::getAllData();
    $provinces_mb = Common::multiSort($data[1],$thu,1);
    $provinces_mt = Common::multiSort($data[2],$thu,1);
    $provinces_mn = Common::multiSort($data[3],$thu,1);

    if(in_array($action,array("miennam","kqMiennam"))){
        $action_header = "kqMiennam";
    }elseif(in_array($action,array("mientrung","kqMientrung"))){
        $action_header = "kqMientrung"; 
    }else{
        $action_header = "kqMienbac";
    }
    
    $link_now = Url::createUrl("result/".$action_header,array("ngay"=>date('d'),"thang"=>date('m'),"nam"=>date('Y')));
    $link_last = Url::createUrl("result/".$action_header,array("ngay"=>date('d',time()-86400),"thang"=>date('m',time()-86400),"nam"=>date('Y',time()-86400)));

?>

<div class="header" xmlns="http://www.w3.org/1999/html">

    <div class="top-info">
        <div class="main clearfix">    
            <div class="logo fl">
                 <a href="<?php echo Yii::app()->params["base_url"]?>" title="Xosothantai.vn" class="txtlogo">
                <img src="/themes/images/Logoxstt.png" width=100% >
                </a>
                <div class="txtlink"><a title="Kết quả xổ số hôm nay" href="<?php echo $link_now ?>"><strong>Hôm nay <?php echo $day["label"]?> ngày <?php echo date('d-m-Y')?></strong></a>&nbsp;|&nbsp;<a title="Kết quả xổ số hôm qua" href="<?php echo $link_last;?>"><strong>Hôm qua</strong></a></div>
            </div>
            <div class="banner468x60" style="float: right" ><!--Banner Quang Cao-->
                <div class="Header_List" style="text-align: center;line-height: 10px;margin-top: 10px;text-align: right">
                    <?php if(isset($_SESSION['mobile_xstt'])){ ?>
                    <p style="color:#990000;font-size: 12px;margin-right: 5px">Xin chào : <?php echo $_SESSION['mobile_xstt']; ?> (<a style="font-size: 12px;color: #990000;text-decoration:underline" href="<?php echo Url::createUrl('login/logout'); ?>">Thoát</a>)</p>
                    <?php } ?>
                    <a href="<?php echo Url::createUrl("about/index")?>">GIỚI THIỆU</a> |
                    <a href="<?php echo Url::createUrl("about/guide")?>">HƯỚNG DẪN SỬ DỤNG</a> </br>
                  <!--  <span>HOTLINE: 1900561588</span> |-->
                </div>
            </div>
            <div class="icrss">
            </div>
            <div onclick="shownav()" class="ic-catemobi"><strong class="ic"></strong></div>
        </div>
    </div>
    <div class="box-sms">
        <?php echo $label_header[rand(0,count($label_header)-1)]?>
    </div>
</div>
<div class="nav">      
    <div class="ic-catemobi" onclick="shownav()"><strong class="ic"></strong></div>
    <ul class="nav-hozital clearfix" id="nav-hozital">
        <li class="fl <?php echo $control=="home" ? '':''?> clearfix">
            <a class="fl" href="<?php echo Url::createUrl("home/index")?>" title="Kết quả xổ số" class="ic ic-home "><strong>Trực Tiếp Xổ số</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-home')"></span>
            <ul class="menu-c2" id="mn-c2-home">
                <li><a href="<?php echo Url::createUrl("home/mienbac")?>" title="Trực tiếp xổ số miền bắc"><strong>Xổ số miền bắc</strong></a></li>
                <li><a href="<?php echo Url::createUrl("home/miennam")?>" title="Trực tiếp xổ số miền nam"><strong>Xổ số miền nam</strong></a></li>
                <li><a href="<?php echo Url::createUrl("home/mientrung")?>" title="Trực tiếp xổ số miền trung"><strong>Xổ số miền trung</strong></a></li>
            </ul>
        </li>


        <li class="fl <?php echo ($control=="result") && in_array($action,array("kqMienbac")) ? 'active':''?> clearfix"> 
            <a href="<?php echo Url::createUrl("result/kqMienbac")?>" title="Kết quả xổ số Miền Bắc"><strong>KQXS miền bắc</strong></a>
        </li>

        <li class="fl <?php echo ($control=="result") && in_array($action,array("kqMiennam")) ? 'active':''?> clearfix"> 
            <a class="fl" href="<?php echo Url::createUrl("result/kqMiennam")?>" title="Kết quả xổ số Miền Nam"><strong>KQXS miền nam</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-miennam')"></span>
            <ul class="menu-c2" id="mn-c2-miennam">
                <?php foreach($provinces_mn as $value){
                        $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));  
                    ?>
                    <li><a href="<?php echo $url_province?>" title="Xổ số <?php echo $value["name"]?>"><strong>Xổ số <?php echo $value["name"]?></strong></a></li>
                    <?php }?>
            </ul>
        </li>

        <li class="fl <?php echo ($control=="result") && in_array($action,array("kqMientrung")) ? 'active':''?> clearfix"> 
            <a class="fl" href="<?php echo Url::createUrl("result/kqMientrung")?>" title="Kết quả xổ số miền trung"><strong>KQXS miền trung</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-mientrung')"></span>
            <ul class="menu-c2" id="mn-c2-mientrung">
                <?php foreach($provinces_mt as $value){
                        $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));  
                    ?>
                    <li><a href="<?php echo $url_province?>" title="Xổ số <?php echo $value["name"]?>"><strong>Xổ số <?php echo $value["name"]?></strong></a></li>
                    <?php }?>
            </ul>
        </li>

        <li class="fl <?php echo $control=="kqthantai" ? 'active':''?> clearfix"><a class="fl" href="<?php echo Url::createUrl("kqthantai/index")?>" title="Mở Bát"><strong>KQ thần tài</strong></a></li>

        <li class="fl <?php echo $control=="statistic" ? 'active':''?> clearfix">
            <a class="fl" class="fl" href="<?php echo Url::createUrl("statistic/chukyLoto")?>" title=""><strong>Thống Kê VIP</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-tk')"></span>
            <ul class="menu-c2" id="mn-c2-tk">
                <li class="<?php echo $action=="lotoGan" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/lotoGan")?>" title="Thống kê loto gan"><strong>Thống kê loto gan</strong></a></li>
                <li class="<?php echo $action=="chukyLoto" ? 'active':''?>"> <a href="<?php echo Url::createUrl("statistic/chukyLoto")?>" title="Thống ke chu kỳ loto"><strong>Thống ke chu kỳ loto</strong></a></li>
                <li class="<?php echo $action=="tansuatLoto" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/tansuatLoto")?>" title="Thống kê tần suất loto"><strong>Thống kê tần suất loto</strong></a></li>
                <li class="<?php echo $action=="nhanh" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/nhanh")?>" title="Thống kê nhanh"><strong>Thống kê nhanh</strong></a></li>
                <li class="<?php echo $action=="dacbiet" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/dacbiet")?>" title="Thống kê giải đặc biệt"><strong>Thống kê giải đặc biệt</strong></a></li>
                <li class="<?php echo $action=="tonghop" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/tonghop")?>" title="Thống kê tổng hợp"><strong>Thống kê tổng hợp</strong></a></li>
                <li class="<?php echo $action=="dauduoiLoto" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/dauduoiLoto")?>" title="Thống kê đầu đuôi loto"><strong>Thống kê đầu đuôi loto</strong></a></li>
                <li class="<?php echo $action=="dauduoiDacbiet" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/dauduoiDacbiet")?>" title="Thống kê đầu đuôi đặc biệt"><strong>Thống kê đầu đuôi đặc biệt</strong></a></li>
            </ul>
        </li>

        <!--<li class="fl <?php echo $control=="dreambook" ? 'active':''?> clearfix"><a class="fl" href="<?php echo Url::createUrl("dreambook/index")?>" title="Sổ Mơ"><strong>Sổ Mơ</strong></a></li>-->
        <li class="fl <?php echo $control=="mobat" ? 'active':''?> clearfix"><a class="fl" href="<?php echo Url::createUrl("mobat/index")?>" title="Mở Bát"><strong>Số Thần Tài</strong></a></li>

        <li class="fl <?php echo $control=="soicau" ? 'active':''?> clearfix">
            <a class="fl" class="fl" href="<?php echo Url::createUrl("soicau/index")?>" title=""><strong>Soi Cầu</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-tk')"></span>
            <ul class="menu-c2" id="mn-c2-tk">
                <li class="<?php echo $action=="index" ? 'active':''?>"><a href="<?php echo Url::createUrl("soicau/index")?>" title="Soi cầu loto"><strong>Soi cầu loto</strong></a></li>
                <li class="<?php echo $action=="dacbiet" ? 'active':''?>"> <a href="<?php echo Url::createUrl("soicau/dacbiet")?>" title="Soi cầu đặc biệt"><strong>Soi cầu đặc biệt</strong></a></li>
                <li class="<?php echo $action=="hainhay" ? 'active':''?>"><a href="<?php echo Url::createUrl("soicau/hainhay")?>" title="Soi cầu hai nháy"><strong>Soi cầu hai nháy</strong></a></li>
            </ul>
        </li>
    </ul>
</div>



<?php if(!in_array($control,array("login","user","lodo")) && !isset($_SESSION["user"]) ){
    if($control !="home" || $action !="index"){
    ?>
    <div class="linkway">
        <div class="main"> 
            <a rel="nofollow" href="<?php echo Url::createUrl("home/index")?>" title=""><strong>Home</strong></a>
            <?php     
                $i=0;
                foreach($this->breadcrumbs as $value){
                    $i++;
                ?>
                &nbsp;&raquo;&nbsp;
                <?php if($i==count($this->breadcrumbs)){?>
                    <strong><?php echo $value["title"]?></strong>
                    <?php }else{?>
                    <a href="<?php echo $value["link"]?>" title="<?php echo $value["title"]?>"><strong><?php echo $value["title"]?></strong></a>
                    <?php }?>

                <?php }?>
        </div>
    </div>
    <?php }
}?>

<div class="bannertop">
    <div class="main clearfix">
        
    </div>
=======
<?php
    $detect = new MobileDetect();
    if($detect->isiOS()){
        $link_down = "https://itunes.apple.com/us/app/xoso/id828154474?ls=1&mt=8";
    }else{
        $link_down = "https://play.google.com/store/apps/details?id=com.hdc.tructiepxoso";
    }
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $label_header = array(
        '<p>Nhận <strong>KQXS miền bắc siêu tốc</strong></p><p>Soạn: <strong class="cl-yll s16">XSMB gửi 19008612</strong></p>',
        '<p>Nhận <strong>KQXS miền nam siêu tốc</strong></p><p>Soạn: <strong class="cl-yll s16">XSMN gửi 19008612</strong></p>',
        '<p>Nhận <strong>KQXS miền trung siêu tốc</strong></p><p>Soạn: <strong class="cl-yll s16">XSMT gửi 19008612</strong></p>',
    );
    $date = getdate(time());
    $day = Common::getWeekDay($date["wday"]);
    $thu = "thu".$day["id"];
    $data = Provinces::getAllData();
    $provinces_mb = Common::multiSort($data[1],$thu,1);
    $provinces_mt = Common::multiSort($data[2],$thu,1);
    $provinces_mn = Common::multiSort($data[3],$thu,1);

    if(in_array($action,array("miennam","kqMiennam"))){
        $action_header = "kqMiennam";
    }elseif(in_array($action,array("mientrung","kqMientrung"))){
        $action_header = "kqMientrung"; 
    }else{
        $action_header = "kqMienbac";
    }
    
    $link_now = Url::createUrl("result/".$action_header,array("ngay"=>date('d'),"thang"=>date('m'),"nam"=>date('Y')));
    $link_last = Url::createUrl("result/".$action_header,array("ngay"=>date('d',time()-86400),"thang"=>date('m',time()-86400),"nam"=>date('Y',time()-86400)));

?>

<div class="header" xmlns="http://www.w3.org/1999/html">

    <div class="top-info">
        <div class="main clearfix">    
            <div class="logo fl">
                 <a href="<?php echo Yii::app()->params["base_url"]?>" title="Xosothantai.vn" class="txtlogo">
                <img src="/themes/images/Logoxstt.png" width=100% >
                </a>
                <div class="txtlink"><a title="Kết quả xổ số hôm nay" href="<?php echo $link_now ?>"><strong>Hôm nay <?php echo $day["label"]?> ngày <?php echo date('d-m-Y')?></strong></a>&nbsp;|&nbsp;<a title="Kết quả xổ số hôm qua" href="<?php echo $link_last;?>"><strong>Hôm qua</strong></a></div>
            </div>
            <div class="banner468x60" style="float: right" ><!--Banner Quang Cao-->
                <div class="Header_List" style="text-align: center;line-height: 10px;margin-top: 10px;text-align: right">
                    <?php if(isset($_SESSION['mobile_xstt'])){ ?>
                    <p style="color:#990000;font-size: 12px;margin-right: 5px">Xin chào : <?php echo $_SESSION['mobile_xstt']; ?> (<a style="font-size: 12px;color: #990000;text-decoration:underline" href="<?php echo Url::createUrl('login/logout'); ?>">Thoát</a>)</p>
                    <?php } ?>
                    <a href="<?php echo Url::createUrl("about/index")?>">GIỚI THIỆU</a> |
                    <a href="<?php echo Url::createUrl("about/guide")?>">HƯỚNG DẪN SỬ DỤNG</a> </br>
                  <!--  <span>HOTLINE: 1900561588</span> |-->
                </div>
            </div>
            <div class="icrss">
            </div>
            <div onclick="shownav()" class="ic-catemobi"><strong class="ic"></strong></div>
        </div>
    </div>
    <div class="box-sms">
        <?php echo $label_header[rand(0,count($label_header)-1)]?>
    </div>
</div>
<div class="nav">      
    <div class="ic-catemobi" onclick="shownav()"><strong class="ic"></strong></div>
    <ul class="nav-hozital clearfix" id="nav-hozital">
        <li class="fl <?php echo $control=="home" ? '':''?> clearfix">
            <a class="fl" href="<?php echo Url::createUrl("home/index")?>" title="Kết quả xổ số" class="ic ic-home "><strong>Trực Tiếp Xổ số</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-home')"></span>
            <ul class="menu-c2" id="mn-c2-home">
                <li><a href="<?php echo Url::createUrl("home/mienbac")?>" title="Trực tiếp xổ số miền bắc"><strong>Xổ số miền bắc</strong></a></li>
                <li><a href="<?php echo Url::createUrl("home/miennam")?>" title="Trực tiếp xổ số miền nam"><strong>Xổ số miền nam</strong></a></li>
                <li><a href="<?php echo Url::createUrl("home/mientrung")?>" title="Trực tiếp xổ số miền trung"><strong>Xổ số miền trung</strong></a></li>
            </ul>
        </li>


        <li class="fl <?php echo ($control=="result") && in_array($action,array("kqMienbac")) ? 'active':''?> clearfix"> 
            <a href="<?php echo Url::createUrl("result/kqMienbac")?>" title="Kết quả xổ số Miền Bắc"><strong>KQXS miền bắc</strong></a>
        </li>

        <li class="fl <?php echo ($control=="result") && in_array($action,array("kqMiennam")) ? 'active':''?> clearfix"> 
            <a class="fl" href="<?php echo Url::createUrl("result/kqMiennam")?>" title="Kết quả xổ số Miền Nam"><strong>KQXS miền nam</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-miennam')"></span>
            <ul class="menu-c2" id="mn-c2-miennam">
                <?php foreach($provinces_mn as $value){
                        $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));  
                    ?>
                    <li><a href="<?php echo $url_province?>" title="Xổ số <?php echo $value["name"]?>"><strong>Xổ số <?php echo $value["name"]?></strong></a></li>
                    <?php }?>
            </ul>
        </li>

        <li class="fl <?php echo ($control=="result") && in_array($action,array("kqMientrung")) ? 'active':''?> clearfix"> 
            <a class="fl" href="<?php echo Url::createUrl("result/kqMientrung")?>" title="Kết quả xổ số miền trung"><strong>KQXS miền trung</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-mientrung')"></span>
            <ul class="menu-c2" id="mn-c2-mientrung">
                <?php foreach($provinces_mt as $value){
                        $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));  
                    ?>
                    <li><a href="<?php echo $url_province?>" title="Xổ số <?php echo $value["name"]?>"><strong>Xổ số <?php echo $value["name"]?></strong></a></li>
                    <?php }?>
            </ul>
        </li>

        <li class="fl <?php echo $control=="kqthantai" ? 'active':''?> clearfix"><a class="fl" href="<?php echo Url::createUrl("kqthantai/index")?>" title="Mở Bát"><strong>KQ thần tài</strong></a></li>

        <li class="fl <?php echo $control=="statistic" ? 'active':''?> clearfix">
            <a class="fl" class="fl" href="<?php echo Url::createUrl("statistic/chukyLoto")?>" title=""><strong>Thống Kê VIP</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-tk')"></span>
            <ul class="menu-c2" id="mn-c2-tk">
                <li class="<?php echo $action=="lotoGan" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/lotoGan")?>" title="Thống kê loto gan"><strong>Thống kê loto gan</strong></a></li>
                <li class="<?php echo $action=="chukyLoto" ? 'active':''?>"> <a href="<?php echo Url::createUrl("statistic/chukyLoto")?>" title="Thống ke chu kỳ loto"><strong>Thống ke chu kỳ loto</strong></a></li>
                <li class="<?php echo $action=="tansuatLoto" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/tansuatLoto")?>" title="Thống kê tần suất loto"><strong>Thống kê tần suất loto</strong></a></li>
                <li class="<?php echo $action=="nhanh" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/nhanh")?>" title="Thống kê nhanh"><strong>Thống kê nhanh</strong></a></li>
                <li class="<?php echo $action=="dacbiet" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/dacbiet")?>" title="Thống kê giải đặc biệt"><strong>Thống kê giải đặc biệt</strong></a></li>
                <li class="<?php echo $action=="tonghop" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/tonghop")?>" title="Thống kê tổng hợp"><strong>Thống kê tổng hợp</strong></a></li>
                <li class="<?php echo $action=="dauduoiLoto" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/dauduoiLoto")?>" title="Thống kê đầu đuôi loto"><strong>Thống kê đầu đuôi loto</strong></a></li>
                <li class="<?php echo $action=="dauduoiDacbiet" ? 'active':''?>"><a href="<?php echo Url::createUrl("statistic/dauduoiDacbiet")?>" title="Thống kê đầu đuôi đặc biệt"><strong>Thống kê đầu đuôi đặc biệt</strong></a></li>
            </ul>
        </li>

        <!--<li class="fl <?php echo $control=="dreambook" ? 'active':''?> clearfix"><a class="fl" href="<?php echo Url::createUrl("dreambook/index")?>" title="Sổ Mơ"><strong>Sổ Mơ</strong></a></li>-->
        <li class="fl <?php echo $control=="mobat" ? 'active':''?> clearfix"><a class="fl" href="<?php echo Url::createUrl("mobat/index")?>" title="Mở Bát"><strong>Số Thần Tài</strong></a></li>

        <li class="fl <?php echo $control=="soicau" ? 'active':''?> clearfix">
            <a class="fl" class="fl" href="<?php echo Url::createUrl("soicau/index")?>" title=""><strong>Soi Cầu</strong></a>
            <span class="in-block ic arr-d fr" onclick="showmnc2('mn-c2-tk')"></span>
            <ul class="menu-c2" id="mn-c2-tk">
                <li class="<?php echo $action=="index" ? 'active':''?>"><a href="<?php echo Url::createUrl("soicau/index")?>" title="Soi cầu loto"><strong>Soi cầu loto</strong></a></li>
                <li class="<?php echo $action=="dacbiet" ? 'active':''?>"> <a href="<?php echo Url::createUrl("soicau/dacbiet")?>" title="Soi cầu đặc biệt"><strong>Soi cầu đặc biệt</strong></a></li>
                <li class="<?php echo $action=="hainhay" ? 'active':''?>"><a href="<?php echo Url::createUrl("soicau/hainhay")?>" title="Soi cầu hai nháy"><strong>Soi cầu hai nháy</strong></a></li>
            </ul>
        </li>
    </ul>
</div>



<?php if(!in_array($control,array("login","user","lodo")) && !isset($_SESSION["user"]) ){
    if($control !="home" || $action !="index"){
    ?>
    <div class="linkway">
        <div class="main"> 
            <a rel="nofollow" href="<?php echo Url::createUrl("home/index")?>" title=""><strong>Home</strong></a>
            <?php     
                $i=0;
                foreach($this->breadcrumbs as $value){
                    $i++;
                ?>
                &nbsp;&raquo;&nbsp;
                <?php if($i==count($this->breadcrumbs)){?>
                    <strong><?php echo $value["title"]?></strong>
                    <?php }else{?>
                    <a href="<?php echo $value["link"]?>" title="<?php echo $value["title"]?>"><strong><?php echo $value["title"]?></strong></a>
                    <?php }?>

                <?php }?>
        </div>
    </div>
    <?php }
}?>

<div class="bannertop">
    <div class="main clearfix">
        
    </div>
>>>>>>> .r404
</div>