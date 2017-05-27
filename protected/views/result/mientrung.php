<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time = !empty($ngay_quay) ? strtotime($ngay_quay) : time();
    $date_result[1] = date('d-m-Y',$time+86400);
    $date_result[-1] = date('d-m-Y',$time-86400);
    $url_date[1] = Url::createUrl("result/kqMientrung",array("ngay"=>date('d',strtotime($date_result[1])),"thang"=>date('m',strtotime($date_result[1])),"nam"=>date('Y',strtotime($date_result[1]))));
    $url_date[-1] = Url::createUrl("result/kqMientrung",array("ngay"=>date('d',strtotime($date_result[-1])),"thang"=>date('m',strtotime($date_result[-1])),"nam"=>date('Y',strtotime($date_result[-1]))));
    $url_action_form = Url::createUrl("result/kqMientrung");
    $action = Yii::app()->controller->action->id;

    $url_search = Yii::app()->params["http_url"].'/kqxsmt-mien-trung';

    $tuong_thuat = 0;
    if($action=="kqMientrung"){
        if((!empty($ngay_quay) && date('d-m-Y',strtotime($ngay_quay))==date('d-m-Y')) || empty($ngay_quay)){
            if(date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
                if(empty($data[date('Y-m-d')]) && empty($data[date('d-m-Y')])){
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
                        $title_h1 = 'KQXSMT - Kết Quả Xổ Số Miền Trung ngày '.date('d/m/Y',$time);
                    }elseif(isset($last) && $last==1){
                        $title_h1 = 'KQXSMT - Kết Quả Xổ Số Miền Trung ngày hôm qua';
                    }else{
                        $title_h1 = 'KQXSMT - Kết Quả Xổ Số Miền Trung';
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
                        $ngay_quay = $key;
                        $j++;
                        if($j <=4){
                            $link_region = Url::createUrl("result/kqMientrung",array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));
                        ?>
                        <li>
                            <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                            <a title="XS miền trung ngày <?php echo date('d/m/Y',strtotime($ngay_quay))?>" href="<?php echo $link_region?>">XS miền trung ngày <?php echo date('d/m/Y',strtotime($ngay_quay))?></a>
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
                    <a title="XS miền trung ngày <?php echo date('d-m-Y',$time-86400)?>" href="<?php echo Url::createUrl("result/kqMientrung",array("ngay"=>date('d',$time-86400),"thang"=>date('m',$time-86400),"nam"=>date('Y',$time-86400)))?>">XS miền trung ngày <?php echo date('d-m-Y',$time-86400)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền trung ngày <?php echo date('d-m-Y',$time-86400*2)?>" href="<?php echo Url::createUrl("result/kqMientrung",array("ngay"=>date('d',$time-86400*2),"thang"=>date('m',$time-86400*2),"nam"=>date('Y',$time-86400*2)))?>">XS miền trung ngày <?php echo date('d-m-Y',$time-86400*2)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền trung ngày <?php echo date('d-m-Y',$time-86400*3)?>" href="<?php echo Url::createUrl("result/kqMientrung",array("ngay"=>date('d',$time-86400*3),"thang"=>date('m',$time-86400*3),"nam"=>date('Y',$time-86400*3)))?>">XS miền trung ngày <?php echo date('d-m-Y',$time-86400*3)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="XS miền trung ngày <?php echo date('d-m-Y',$time-86400*4)?>" href="<?php echo Url::createUrl("result/kqMientrung",array("ngay"=>date('d',$time-86400*4),"thang"=>date('m',$time-86400*4),"nam"=>date('Y',$time-86400*4)))?>">XS miền trung ngày <?php echo date('d-m-Y',$time-86400*4)?></a>
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
        <?php 
            if($tuong_thuat==1){
                $provinces_now = Provinces::getDataInDay(date('d-m-Y'));
                if(count($provinces_now[2])==4){
                    $class_now = "four"; 
                }elseif(count($provinces_now[2])==2){
                    $class_now = "two";
                }else{
                    $class_now = "three";
                }
               
            ?>
            <div class="tit-mien clearfix">
                <h2 class="txt-center s18">
                    XSMN - Xổ số miền trung ngày <?php echo date('d-m-Y')?>
                </h2>
            </div>
            <div class="<?php echo $class_now;?>-city" id="load_kq_mt_0"></div>
            <?php }?> 
        <?php  
            $i =0;
            foreach($data as $key=>$value){
                $i++;
                $provinces = array();
                $ngay_quay = $key;
                foreach($value as $result){
                    $provinces[$result["province_id"]] = $provinces_rg[$result["province_id"]];
                    krsort($provinces);
                    $loto[$result["province_id"]] = Common::getLotoMT($result);
                    if(count($provinces)==4){
                        $class = "four"; 
                    }elseif(count($provinces)==2){
                        $class = "two";
                    }else{
                        $class = "three";
                    } 
                }  
            ?>
            <div class="box">
                <?php if($i==1){?>
                    <div class="txt-center">
                        <?php 
                            $this->renderPartial("application.views.layouts.adsend");
                        ?>
                    </div>
                    <?php }?>
                <div class="tit-mien clearfix">
                    <h2 class="txt-center s18">
                        <?php if(isset($last) && $last==1){?>
                            XSMT - Xổ số miền trung ngày hôm qua - <?php echo date('d-m-Y',strtotime($key))?>
                            <?php }else{?>
                            XSMT - Xổ số miền trung ngày <?php echo date('d-m-Y',strtotime($key))?>
                            <?php }?>
                    </h2>
                </div>
                <div class="<?php echo $class;?>-city" id="load_kq_mt_<?php echo $i?>">
                    <?php $this->renderPartial("application.views.home.load_kqmt",array("data"=>$value,"provinces"=>$provinces,"loto"=>$loto,"ngay_quay"=>$ngay_quay))?>
                </div>
                <?php if($i==1){?>
                    <div class="cp-sms">
                       

                    </div>
                    <?php }?>
                <div class="conect_out pad5">
                    <?php if($i==1){
                        $this->renderPartial("application.views.layouts.social_home");
                    }?>
                </div>
                <?php if($i==1){?>
                    <div class="txt-center">
                        <?php 
                            $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"));
                        ?>
                    </div>
                    <?php }?>
            </div>
            <?php }?>
        <?php }else{?>
        <div class="tit-mien txt-center clearfix">
            <h2 class="s18">XSMT - Xổ số miền trung ngày <?php echo date("d/m/Y",$time);?></h2>
        </div>
        <div class="notifi">
            <p><strong class="clred">Hệ thống không tìm thấy </strong> có KQXS miền trung ngày <?php echo date("d/m/Y",$time);?>!</p>
            <p>Click vào <a title="" href="<?php echo $url_action_form;?>"><strong>đây</strong></a> để xem kết quả xổ số miền trung vào ngày khác</p>
        </div>
        <?php
            $time_month = strtotime(date('Y-m-d',$time)." -1 month");
            $month_result = date('d-m-Y',$time_month);
            $data_month = KetquaMientrung::getDataByDate($month_result);
            $loto = array();
            $provinces = array();
            foreach($data_month as $result){
                $provinces[$result["province_id"]] = $provinces_rg[$result["province_id"]];
                krsort($provinces);
                $loto[$result["province_id"]] = Common::getLotoMT($result);
                if(count($provinces)==4){
                    $class = "four"; 
                }elseif(count($provinces)==2){
                    $class = "two";
                }else{
                    $class = "three";
                } 
            }
        ?>
        <div class="tit-mien txt-center clearfix">
            <h2 class="s18">XSMT - Xổ số miền trung ngày <?php echo date('d/m/Y',$time_month)?></h2>
        </div>

        <div class="<?php echo $class;?>-city">
            <?php $this->renderPartial("application.views.home.load_kqmt",array("data"=>$data_month,"provinces"=>$provinces,"loto"=>$loto,"ngay_quay"=>$month_result))?>
        </div>
        <?php }?>
    <?php if($max_page >1){?>
        <div class="paging txt-right pad10-5">
            <?php       
                $path = Url::createUrl("result/kqMientrung");
                $path = str_replace(".html","",$path);
                echo Paging::showPageNavigation($page,$max_page,$path."/");
            ?>
        </div>
        <?php }?>
    <div class="box">
        <div class="box-nd pad10">
            <div class="tit-mien txt-center clearfix">
                <h2 class="s18">
                    Cơ cấu giải thưởng xổ số miền trung
                </h2>
            </div>
            <div class="title-c1">
                <em>Xổ số Miền trung được mở thưởng hàng ngày vào hồi 17h10'. Xổ số miền trung được quay thưởng tại công ty xổ số kiến thiết của tỉnh mà hôm đó đến lịch mở thưởng. (Xem <a href="http://xosothantai.vn/lich-quay-ket-qua-xo-so.html">lịch quay xổ số miền trung</a>)</em>
                <br />Địa điểm quay thưởng: Công ty TNHH MTV XSKT Tỉnh
            </div>
            <ul class="magb10">
                <li class="pad5"><strong>Cơ cấu giải thưởng xổ số miền Trung -  Cho 100.000 vé xổ số truyền thống loại vé 5.000đ như sau:</strong>
                    <ul>
                        <li>
                            <strong>01 Giải Đặc biệt:</strong> trị giá 125.000.000 đ
                        </li>
                        <li>
                            <strong>01 Giải nhất:</strong> trị giá 20.000.000 đ
                        </li>
                        <li>
                            <strong>01 Giải nhì:</strong> trị giá 5.000.000 đ    
                        </li>
                        <li>
                            <strong>02 Giải ba:</strong> mỗi giải trị giá 2.500.000 đ
                        </li>
                        <li>
                            <strong>07 Giải tư:</strong> mỗi giải trị giá 1.250.000 đ
                        </li>
                        <li>
                            <strong>10 Giải năm:</strong> mỗi giải trị giá 500.000 đ
                        </li>
                        <li>
                            <strong>30 Giải sáu:</strong> mỗi giải trị giá 250.000 đ
                        </li>
                        <li>
                            <strong>100 Giải bảy:</strong> mỗi giải trị giá 125.000 đ
                        </li>
                        <li>
                            <strong>1000 Giải tám:</strong> mỗi giải trị giá 50.000 đ
                        </li>
                        <li>
                            Và có 45 giải khuyến khích, mỗi giải trị giá 250.000 đồng dành cho những vé chỉ sai 1 con số bất cứ hàng nào theo thứ tự so với giải đặc biệt.
                        </li>
                    </ul>
                </li>
                <li class="pad5">
                    <strong>Cơ cấu giải thưởng này được thống nhất áp dụng cho tất cả các Công ty XSKT Khu vực Miền Trung - Tây Nguyên.</strong>
                </li>
                <li class="pad5">
                    <strong>Xổ xố miền trung mở thưởng vào tất cả các ngày từ thứ 2 đến Chủ Nhật hàng tuần</strong>
                </li>
                <li class="pad5">
                    <strong>Kết quả xổ số miền trung được xosothantai.vn tường thuật trực tiếp từ trường quay các Tỉnh/TP</strong>             
                </li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">

    function loadKetquaMientrung(strUrl){
        $.ajax({
            type: "GET",
            url: strUrl,
            data: {},
            beforeSend : function(){
                var text = $("#load_kq_mt_0").html();
                $("#load_kq_mt_0").html(text);
            },
            error: function(request,error) 
            {
                var text = $("#load_kq_mt_0").html();
                $("#load_kq_mt_0").html(text);
            },
            success: function(msg){  
                if(msg !=""){
                    $("#load_kq_mt_0").html(msg); 
                }         
            }
        });
    }

    function loadMientrung(){           
        var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;  
        if(is_chrome){
            var t = new Date().getTime();
        }else{
            var t = new Date('<?php echo date('Y')?>','<?php echo date('m')?>','<?php echo date('d')?>').getTime();
        }            
        var strUrl = '/kkt_api/livexs/MienTrungTT.html?t='+t;
        loadKetquaMientrung(strUrl);  
    }
    $(document).ready(function(){
        <?php if($tuong_thuat==1){?>
            loadMientrung();
            setInterval(
                function(){
                    loadMientrung();
                },1000
            ); 
            <?php }?>  
        
    }); 
</script>