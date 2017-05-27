<?php
    $detect = new MobileDetect();
    $date = getdate(time());
    $day = Common::getWeekDay($date["wday"]);
    $thu = "thu".$day["id"];
    $action = Yii::app()->controller->action->id;
    /*if($province[$thu]==1 || $province["id"]==1){
        if(date("H",time()) == LoadConfig::$region[$rg]["hour_live"]){
            if((isset($_GET["ngay_quay"]) && $_GET["ngay_quay"]==date('d-m-Y',time())) || !isset($_GET["ngay_quay"])){
                $data["ngay_quay"] = date('d-m-Y',time());
            }
        }
    }*/    
    $time = isset($ngay_quay) ? strtotime($ngay_quay) : time();
    $date_quay = getdate($time);
    if($action=="miennam"){
        $url_search = Yii::app()->params["http_url"].'/mien-nam/xs'.$province["code"].'-'.$province["alias"].'';
        $sc = '8212';
        $region = 'MN';
        $title_h2 = "miền nam";
        list($date_result,$time_live) = Common::getDataProvinceLive("mn",$province,$time);
        list($date_next,$time_live_next) = Common::getDataProvinceLive("mn",$province,$time);
        $template = "load_kq_tinh";
        $title_region = "KQXS miền nam";
        $url_region = Url::createUrl("result/kqMiennam");
        $url_load_kq_province = '/ttkq/mien-nam/xosome_'.$province["id"].'.html';
    }elseif($action=="mientrung"){
        $url_search = Yii::app()->params["http_url"].'/mien-trung/xs'.$province["code"].'-'.$province["alias"].'';
        $sc = '8212';  
        $region = 'MT';
        $title_h2 = "miền trung";
        list($date_result,$time_live) = Common::getDataProvinceLive("mt",$province,$time);
        list($date_next,$time_live_next) = Common::getDataProvinceLive("mt",$province,$time);
        $template = "load_kq_tinh";
        $title_region = "KQXS miền trung";
        $url_region = Url::createUrl("result/kqMientrung");
        $url_load_kq_province = '/ttkq/mien-trung/xosome_'.$province["id"].'.html';
    }else{     
        $url_search = Yii::app()->params["http_url"].'/mien-bac/xs'.$province["code"].'-'.$province["alias"].'';   
        $sc = '8012';  
        $region = 'MB';
        $title_h2 = "miền bắc";
        list($date_result,$time_live) = Common::getDataProvinceLive("mb",$province,$time);
        list($date_next,$time_live_next) = Common::getDataProvinceLive("mb",$province,$time);
        $template = "application.views.home.load_kqmb";
        $title_region = "KQXS miền bắc";
        $url_region = Url::createUrl("result/kqMienbac");
        $url_load_kq_province = '/ttkq/xosome_mien-bac.html';  
    }
    $url_action_form = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
    $url_date[1] = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($date_result[1])),"thang"=>date('m',strtotime($date_result[1])),"nam"=>date('Y',strtotime($date_result[1]))));
    $url_date[0] = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',$time),"thang"=>date('m',$time),"nam"=>date('Y',$time)));
    $url_date[-1] = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($date_result[-1])),"thang"=>date('m',strtotime($date_result[-1])),"nam"=>date('Y',strtotime($date_result[-1]))));
    $url_date[-2] = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($date_result[-2])),"thang"=>date('m',strtotime($date_result[-2])),"nam"=>date('Y',strtotime($date_result[-2]))));
    $url_date[-3] = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($date_result[-3])),"thang"=>date('m',strtotime($date_result[-3])),"nam"=>date('Y',strtotime($date_result[-3]))));

    $tuong_thuat = 0;
    if($province[$thu]==1 || $province["id"]==1){
        //echo $ngay_quay;die;
        if((!empty($ngay_quay) && date('d-m-Y',strtotime($ngay_quay))==date('d-m-Y')) || empty($ngay_quay)){
            if(date('H',time())==LoadConfig::$region[$rg]["hour_live"]){
                $tuong_thuat = 1;
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
                XS<?php echo strtoupper($province["code"])?> - Xổ số <?php echo $province["name"] ?> 
                <?php 
                    if(isset($_GET["ngay_quay"])){
                        echo 'ngày '.date('d/m/Y',$time); 
                    }    
                ?>      
            </strong>
        </h1>
    </div>
    <div class="box">
        <ul class="list-dot-red linkcol2">
            <li>
                <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="KQXS <?php echo $province["name"] ?> ngày <?php echo $date_result[-1]?>" href="<?php echo $url_date[-1]?>">KQXS <?php echo $province["name"]?> ngày <?php echo $date_result[-1]?></a>
            </li>
            <li>
                <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="KQXS <?php echo $province["name"] ?> ngày <?php echo $date_result[-2]?>" href="<?php echo $url_date[-2]?>">KQXS <?php echo $province["name"]?> ngày <?php echo $date_result[-2]?></a>
            </li>
            <li>
                <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="KQXS <?php echo $province["name"] ?> ngày <?php echo $date_result[-3]?>" href="<?php echo $url_date[-3]?>">KQXS <?php echo $province["name"]?> ngày <?php echo $date_result[-3]?></a>
            </li>
            <li>
                <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="<?php echo $title_region ?>" href="<?php echo $url_region?>"><?php echo $title_region ?></a>
            </li>   
        </ul>
    </div>
    <div class="box-kq">
        <div class="box">
            <div class="title-bor magb10">
                <div class="opt_date opt_date_full">
                    <select id="ngay">
                        <?php for($i=1;$i<=31;$i++){?>
                            <option value="<?php echo $i?>" <?php echo  date("d",$time)==$i ? 'selected':''?>>Ngày <?php echo $i?></option>
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
                    <button class="bt-red" type="button" onclick="searchKQ('<?php echo $url_search;?>','<?php echo $province["id"];?>')"><strong>Tìm</strong></button>
                </div>
            </div>
            <?php $this->renderPartial("application.views.layouts.adsend");?>
            <div class="tit-mien txt-center clearfix">
                <h2 class="s18">Xổ số <?php echo $province["name"];?> ngày <?php echo date("d/m/Y",$time)?> (<?php echo $day["label"] ?>)</h2>
            </div>
            <?php if($data || $tuong_thuat==1){?>
                <div class="col-2 clearfix" id="load_kq_tinh">   
                    <?php 
                        if($data){
                            $this->renderPartial($template,array("data"=>$data,"loto"=>$loto,"province"=>$province));
                        }
                    ?>
                </div>
                <?php }else{?>
                <div class="notifi">
                    <p><strong class="clred">Hệ thống không tìm thấy </strong> có KQXS <?php echo $province["name"];?> ngày <?php echo date("d/m/Y",$time);?>!</p>
                    <p>Click vào <a title="" href="<?php echo $url_action_form;?>"><strong>đây</strong></a> để xem kết quả xổ số <?php echo $province["name"];?> vào ngày khác</p>
                </div>
                <?php
                    $day_old = date('d',$time);
                    if($province["region"]==3){
                        $data_old = KetquaMiennam::getDataByProvinceAndDay($province["id"],$day_old);
                        $loto_old = Common::getLotoMN($data_old);
                    }elseif($province["region"]==2){
                        $data_old = KetquaMientrung::getDataByProvinceAndDay($province["id"],$day_old);
                        $loto_old = Common::getLotoMT($data_old);
                    }else{
                        $data_old = KetquaMienbac::getDataByDay($day_old);
                        $loto_old = Common::getLotoMB($data_old);
                    } 
                    $date_old = getdate(strtotime($data_old["ngay_quay"]));
                    $day_time_old = Common::getWeekDay($date_old["wday"]);
                ?>
                <div class="tit-mien txt-center clearfix">
                    <h2 class="s18">Xổ số <?php echo $province["name"];?> ngày <?php echo date("d/m/Y",strtotime($data_old["ngay_quay"]))?> (<?php echo $day_time_old["label"] ?>)</h2>
                </div>
                <div class="col-2 clearfix">
                    <?php $this->renderPartial($template,array("data"=>$data_old,"loto"=>$loto_old,"province"=>$province));?>
                </div>
                <?php }?>
            <div class="cp-sms">
                <p>- Nhận kết quả xổ số <?php echo $title_h2;?> nhanh siêu tốc.  
                    Soạn <span class="clsms"><strong>XS<?php echo $region?></strong></span> gửi <span class="clsms"><strong><?php echo $sc;?></strong></span>
                </p>
            </div>
        </div>

        <div class="box loto-mb">

            <?php $this->renderPartial("application.views.home.load_tk_boso",
                    array(
                        "first_province"=>$province
                        ,"data_tk10"=>$data_tk10
                        ,"data_tk20"=>$data_tk20
                        ,"data_gan"=>$data_gan
                    )
                )
            ?>
        </div>

        <?php if(!empty($province["content_xsme"])){?>
            <div class="box pad5">
                <?php echo $province["content_xsme"] ?>    
            </div>
            <?php }?>
        <?php if(!empty($province["seo_xsme"])){?>
            <div class="box pad5">
                <?php echo $province["seo_xsme"] ?>    
            </div>
            <?php }?>
    </div>
</div>


<script type="text/javascript">
    function loadKetquaProvince(strUrl){
        $.ajax({
            type: "GET",
            url: strUrl,
            data: {
            },
            success: function(msg){  
                if(msg !=""){
                    $("#load_kq_tinh").html(msg);
                }          
            }
        });
    }
    function loadProvince(){  
        var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;  
        if(is_chrome){
            var t = new Date().getTime();
        }else{
            var t = new Date('<?php echo date('Y')?>','<?php echo date('m')?>','<?php echo date('d')?>').getTime();
        }        
        var strUrl = '<?php echo $url_load_kq_province ?>?t='+t;
        loadKetquaProvince(strUrl);  
    }
    
        $(document).ready(function(){
            <?php if($tuong_thuat==1){ ?>
            loadProvince();
            setInterval(
                function(){
                    loadProvince();
                },1000
            ); 
            <?php }?>
            
        }); 
        
</script>