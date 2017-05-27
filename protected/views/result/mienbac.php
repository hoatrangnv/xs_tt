<?php
    $first_data = !empty($data) ? reset($data) : array();
    $time = !empty($ngay_quay) ? strtotime($ngay_quay) : time();
    $date_result[1] = date('d-m-Y',$time+86400);
    $date_result[-1] = date('d-m-Y',$time-86400);
    $url_date[1] = Url::createUrl("result/kqMienbac",array("ngay"=>date('d',strtotime($date_result[1])),"thang"=>date('m',strtotime($date_result[1])),"nam"=>date('Y',strtotime($date_result[1]))));
    $url_date[-1] = Url::createUrl("result/kqMienbac",array("ngay"=>date('d',strtotime($date_result[-1])),"thang"=>date('m',strtotime($date_result[-1])),"nam"=>date('Y',strtotime($date_result[-1]))));
    $url_action_form = Url::createUrl("result/kqMienbac");
    $action = Yii::app()->controller->action->id;

    
    $url_search = Yii::app()->params["http_url"].'/kqxsmb-mien-bac';

    $tuong_thuat = 0;
    if($action=="kqMienbac"){
        if((!empty($ngay_quay) && date('d-m-Y',strtotime($ngay_quay))==date('d-m-Y')) || empty($ngay_quay)){
            if(date('H',time())==LoadConfig::$region["mb"]["hour_live"]){
                 echo   "". $tuong_thuat;  
                if(empty($first_data["ngay_quay"]) || $first_data["ngay_quay"]!=date('Y-m-d')){
                    $tuong_thuat = 1;
                    
                }
            }
        }
    }       
?>
<style>
    .ui-datepicker-trigger{cursor:pointer}
</style>

<div class="col-l">

    <div class="box info-city">
        <h1 class="title-bor mag0">
            <strong>
                <?php
                    if(!empty($_GET["ngay"])){
                        $title_h1 = 'KQXSMB - Kết Quả Xổ Số Miền Bắc ngày '.date('d/m/Y',$time);
                    }elseif(isset($last) && $last==1){
                        $title_h1 = 'KQXSMB - Kết Quả Xổ Số Miền Bắc ngày hôm qua';
                    }else{
                        $title_h1 = 'KQXSMB - Kết Quả Xổ Số Miền Bắc';
                    }
                    echo $title_h1;
                ?>   
            </strong>
        </h1>

    </div>
    <?php if(empty($_GET["ngay"]) && empty($last)){?>
        <div class="box">
            <ul class="list-dot-red linkcol2">
                <?php  
                    $j=0;
                    foreach($data as $key=>$value){
                        $j++;
                        if($j <=4){
                            $link_region = Url::createUrl("result/kqMienbac",array("ngay"=>date('d',strtotime($value["ngay_quay"])),"thang"=>date('m',strtotime($value["ngay_quay"])),"nam"=>date('Y',strtotime($value["ngay_quay"]))));
                        ?>
                        <li>
                            <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                            <a title="XS miền bắc ngày <?php echo date('d/m/Y',strtotime($value["ngay_quay"]))?>" href="<?php echo $link_region?>">XS miền bắc ngày <?php echo date('d/m/Y',strtotime($value["ngay_quay"]))?></a>
                        </li> 
                        <?php }
                }?>
            </ul>
        </div>
        <?php }else{?>      
        <div class="box">
            <ul class="list-dot-red linkcol2">
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền bắc ngày <?php echo date('d-m-Y',$time-86400)?>" href="<?php echo Url::createUrl("result/kqMienbac",array("ngay"=>date('d',$time-86400),"thang"=>date('m',$time-86400),"nam"=>date('Y',$time-86400)))?>">XS miền bắc ngày <?php echo date('d-m-Y',$time-86400)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền bắc ngày <?php echo date('d-m-Y',$time-86400*2)?>" href="<?php echo Url::createUrl("result/kqMienbac",array("ngay"=>date('d',$time-86400*2),"thang"=>date('m',$time-86400*2),"nam"=>date('Y',$time-86400*2)))?>">XS miền bắc ngày <?php echo date('d-m-Y',$time-86400*2)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền bắc ngày <?php echo date('d-m-Y',$time-86400*3)?>" href="<?php echo Url::createUrl("result/kqMienbac",array("ngay"=>date('d',$time-86400*3),"thang"=>date('m',$time-86400*3),"nam"=>date('Y',$time-86400*3)))?>">XS miền bắc ngày <?php echo date('d-m-Y',$time-86400*3)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền bắc ngày <?php echo date('d-m-Y',$time-86400*4)?>" href="<?php echo Url::createUrl("result/kqMienbac",array("ngay"=>date('d',$time-86400*4),"thang"=>date('m',$time-86400*4),"nam"=>date('Y',$time-86400*4)))?>">XS miền bắc ngày <?php echo date('d-m-Y',$time-86400*4)?></a>
                </li>
            </ul>
        </div>
        <?php }?>
    <div class="title-bor magb10">
        <div class="opt_date opt_date_full">
            <select id="ngay">
                <?php for($i=1;$i<=31;$i++){?>
                    <option value="<?php echo $i?>" <?php echo date("d",$time)==$i ? 'selected':''?>>Ngày <?php echo $i?></option>
                    <?php }?>
            </select>
            <select id="thang">
                <?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i?>" <?php echo date("m",$time)==$i ? 'selected':''?>>Tháng <?php echo $i?></option>
                    <?php }?>
            </select>
            <select id="nam">
                <?php for($i=2010;$i<=date('Y');$i++){?>
                    <option value="<?php echo $i?>" <?php echo date("Y",$time)==$i ? 'selected':''?>>Năm <?php echo $i?></option>
                    <?php }?>
            </select>
            <button class="bt-red" type="button" onclick="searchKQ('<?php echo $url_search;?>',0)"><strong>Tìm</strong></button>
        </div>
    </div>
    <?php if($data || $tuong_thuat==1){?>
        <?php if($tuong_thuat==1){
                $province_lives = Provinces::getDataInDay(date('d-m-Y'));
                $province  = reset($province_lives[1]);
            ?>
            <div class="box">   
                <div class="tit-mien txt-center clearfix">
                    <h2 class="s18">
                        XSMB - Xổ số miền bắc ngày <?php echo date("d-m-Y")?> (<?php echo $province["name"] ?>)
                    </h2>
                </div>
                <div class="col-2 clearfix" id="load_kq_mb_0"></div>  
            </div>
            <?php }?>
        <?php 
            $i =0;
            foreach($data as $key=>$value){ 
                $i++;
                $day = getdate(strtotime($value["ngay_quay"])); 
                $wday = Common::getWeekDay($day["wday"]); 
                foreach($provinces_rg as $prov){
                    if($prov["thu".$wday["id"]]==1){
                        $province = $prov;break;
                    }
                }
                $loto = Common::getLotoMB($value);
            ?>
            <div class="box">
                <?php if($i==1){?>
                    <div class="txt-center">
                        <?php  $this->renderPartial("application.views.layouts.adsend");?>
                    </div>
                    <?php }?>
                <div class="tit-mien txt-center clearfix">
                    <h2 class="s18">
                        <?php if(isset($last) && $last==1){?>
                            XSMB - Xổ số <?php echo $province["name"] ?> ngày hôm qua
                            <?php }else{?>
                            XSMB - Xổ số miền bắc ngày <?php echo date("d-m-Y",strtotime($value["ngay_quay"]))?> (<?php echo $province["name"] ?>)
                            <?php }?>
                    </h2>
                </div>


                <div class="col-2 clearfix" id="load_kq_mb_<?php echo $i?>">
                    <?php $this->renderPartial("application.views.home.load_kqmb",array("data"=>$value,"loto"=>$loto,"province"=>$province))?>
                </div>
                <?php if($i==1){?>
                    <div class="cp-sms">
                      
                    </div>
                    <?php }?>
            </div>
            <?php }?>
        <?php }else{?>
        <?php
            $day = getdate($time); 
            $wday = Common::getWeekDay($day["wday"]); 
            foreach($provinces_rg as $prov){
                if($prov["thu".$wday["id"]]==1){
                    $province = $prov;break;
                }
            }
        ?>
        <div class="tit-mien txt-center clearfix">
            <h2 class="s18">XSMB - Xổ số miền bắc ngày <?php echo date("d/m/Y",$time);?> (<?php echo $province["name"] ?>)</h2>
        </div>
        <div class="notifi">
            <p><strong class="clred">Hệ thống không tìm thấy </strong> có KQXS miền bắc ngày <?php echo date("d/m/Y",$time);?>!</p>
            <p>Click vào <a title="" href="<?php echo $url_action_form;?>"><strong>đây</strong></a> để xem kết quả xổ số miền bắc vào ngày khác</p>
        </div>

        <?php
            $time_month = strtotime(date('Y-m-d',$time)." -1 month");
            $month_result = date('d-m-Y',$time_month);
            $data_month = KetquaMienbac::getDataByDate($month_result);
            $loto_month = Common::getLotoMB($data_month);
            $day = getdate($time_month); 
            $wday = Common::getWeekDay($day["wday"]); 
            foreach($provinces_rg as $prov){
                if($prov["thu".$wday["id"]]==1){
                    $province = $prov;break;
                }
            }
        ?>
        <div class="tit-mien txt-center clearfix">
            <h2 class="s18">XSMB - Xổ số miền bắc ngày <?php echo date("d/m/Y",$time_month);?> (<?php echo $province["name"] ?>)</h2>
        </div>
        <div class="col-2 clearfix">
            <?php $this->renderPartial("application.views.home.load_kqmb",array("data"=>$data_month,"loto"=>$loto_month,"province"=>$province))?>
        </div>
        <?php }?>

    <?php if($max_page >1){?>
        <div class="paging txt-right pad10-5">
            <?php       
                $path = Url::createUrl("result/kqMienbac");
                $path = str_replace(".html","",$path);
                echo Paging::showPageNavigation($page,$max_page,$path."/");
            ?>
        </div>
        <?php }?>
    <?php if(!empty($province_mb["content_xsme"])){?>
        <div class="box pad5">
            <?php echo $province_mb["content_xsme"] ?>    
        </div>
        <?php }?>
    <?php if(!empty($province_mb["seo_xsme"])){?>
        <div class="box pad5">
            <?php echo $province_mb["seo_xsme"] ?>    
        </div>
        <?php }?>
    <?php if($page==1 && !isset($_GET["ngay"])){?>
        <div class="box">
            <div class="box-nd">
                <h2 class="title-bor pad5">
                    Cơ cấu giải thưởng xổ số miền Bắc
                </h2>
                <div class="title-c2">
                    <em>Xổ số <strong>Miền Bắc</strong> (còn gọi là xổ số truyền thống, xổ số thủ đô hay xổ số Hà Nội) mở thưởng vào khoảng <strong>18h15'</strong> hàng ngày từ thứ 2 đến thứ 7 tại số 1 Tăng Bạt Hổ, Hoàn Kiếm, Hà Nội. 
                        <br>Xổ số <strong>miền bắc</strong> mở thưởng luân phiên tại các Tỉnh/Thành: <strong>Hà nội</strong> (Thứ 2, thứ 5), <strong>Quảng Ninh</strong> (Thứ 3), <strong>Bắc Ninh</strong> (Thứ 4), <strong>Hải phòng</strong> (Thứ 6), <strong>Nam định</strong> (Thứ 7), <strong>Thái bình</strong> (Chủ nhật)</em>
                </div>
                <ul class="magb10">
                    <li class="pad5">
                        <strong>Cơ cấu giải thưởng xổ số miền bắc - Loại vé 10.000đ. Có 81.150 giải thưởng (27 lần quay) như sau:</strong>
                        <ul>
                            <li>
                                <strong>Giải Đặc biệt:</strong> Giá trị giải thưởng (VNĐ): 200.000.000 - Số lượng giải: 15 - Tổng giá trị giải thưởng (VNĐ): 3.000.000.000 - Trị giá mỗi giải so với giá vé mua: 20.000 lần
                            </li>
                            <li>
                                <strong>Giải nhất:</strong> Giá trị giải thưởng (VNĐ): 20.000.000 - Số lượng giải: 15 - Tổng giá trị giải thưởng (VNĐ): 300.000.000 - Trị giá mỗi giải so với giá vé mua: 2.000 lần
                            </li>
                            <li>
                                <strong>Giải nhì:</strong> Giá trị giải thưởng (VNĐ): 5.000.000 - Số lượng giải: 30 - Tổng giá trị giải thưởng (VNĐ): 150.000.000 - Trị giá mỗi giải so với giá vé mua: 500 lần    
                            </li>
                            <li>
                                <strong>Giải ba:</strong> Giá trị giải thưởng (VNĐ): 2.000.000 - Số lượng giải: 90 - Tổng giá trị giải thưởng (VNĐ): 180.000.000 - Trị giá mỗi giải so với giá vé mua: 200 lần
                            </li>
                            <li>
                                <strong>Giải tư:</strong> Giá trị giải thưởng (VNĐ): 400.000 - Số lượng giải: 600 - Tổng giá trị giải thưởng (VNĐ): 240.000.000 - Trị giá mỗi giải so với giá vé mua: 40 lần
                            </li>
                            <li>
                                <strong>Giải năm:</strong> Giá trị giải thưởng (VNĐ): 200.000 - Số lượng giải: 900 - Tổng giá trị giải thưởng (VNĐ): 180.000.000 - Trị giá mỗi giải so với giá vé mua: 20 lần
                            </li>
                            <li>
                                <strong>Giải sáu:</strong> Giá trị giải thưởng (VNĐ): 100.000 - Số lượng giải: 4500 - Tổng giá trị giải thưởng (VNĐ): 450.000.000 - Trị giá mỗi giải so với giá vé mua: 10 lần
                            </li>
                            <li>
                                <strong>Giải bảy:</strong> Giá trị giải thưởng (VNĐ): 40.000 - Số lượng giải: 60000 - Tổng giá trị giải thưởng (VNĐ): 2.400.000.000 - Trị giá mỗi giải so với giá vé mua: 4 lần
                            </li> 
                        </ul>
                    </li>
                    <li class="pad5"><strong>Xổ xố kiến thiết miền bắc mở thưởng vào tất cả các ngày từ thứ 2 đến Chủ Nhật hàng tuần</strong>
                    </li>
                    <li class="pad5"><strong>Kết quả xổ số miền bắc được xosothantai.vn tường thuật trực tiếp từ hội đồng XSKT Miền Bắc</strong>             
                    </li>
                    <li class="pad5"><strong>Vé trùng nhiều giải được lĩnh đủ giá trị các giải </strong></li>
                    <li class="pad5">
                        <strong>Từ khóa liên quan</strong>
                        <p>Xổ số miền bắc, kết quả xổ số miền bắc, kết quả sổ xố miền bắc, xổ số miền bắc hôm nay, kqxs miền bắc, xổ số trực tiếp miền bắc, xổ số kiến thiết miền bắc, kqxsmb</p>
                    </li>
                </ul>
            </div>
        </div>
        <?php }?>
</div>
<script type="text/javascript">

    function loadKetquaMienbac(strUrl){
        $.ajax({
            type: "GET",
            url: strUrl,
            data: "",
            beforeSend : function(){
                var text = $("#load_kq_mb_0").html();
                $("#load_kq_mb_0").html(text);
            },
            error: function(request,error) 
            {
                var text = $("#load_kq_mb_0").html();
                $("#load_kq_mb_0").html(text);
            },
            success: function(msg){  
                if(msg !=""){
                    $("#load_kq_mb_0").html(msg); 
                }         
            }
        });
    }

    function loadMienbac(){          
        var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;  
        if(is_chrome){
            var t = new Date().getTime();
        }else{
            var t = new Date('<?php echo date('Y')?>','<?php echo date('m')?>','<?php echo date('d')?>').getTime();
        }             
        var strUrl = '/kkt_api/livexs/MienBacTT.html?t='+t;
        loadKetquaMienbac(strUrl);          
    }

    $(document).ready(function(){
        <?php  if($tuong_thuat==1){ ?>
            loadMienbac();
            setInterval(
                function(){
                    loadMienbac();
                },1000
            ); 
            <?php } ?>
        
    });

</script>