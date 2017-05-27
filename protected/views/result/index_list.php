<?php
    $first_data = reset($data);
    $action = Yii::app()->controller->action->id;
    $time = isset($first_data["ngay_quay"]) ? strtotime($first_data["ngay_quay"]) : time();
    $date_quay = getdate(time());
    $day_quay = Common::getWeekDay($date_quay["wday"]);
    $thu = "thu".$day_quay["id"];
    if($action=="miennam"){
        $url_search = Yii::app()->params["http_url"].'/mien-nam/xs'.$province["code"].'-'.$province["alias"].'';
        $sc = '8212';
        $region = 'MN';
        $title_h2 = "miền nam";
        $title_region = "Kết quả xổ số miền nam";
        $url_region = Url::createUrl("result/kqMiennam");
        list($date_result,$time_live) = Common::getDataProvinceLive("mn",$province,$time);
        list($date_next,$time_live_next) = Common::getDataProvinceLive("mn",$province,$time);
        $template = "load_kq_tinh";  
        $url_load_kq_province = '/ttkq/mien-nam/xosome_'.$province["id"].'.html';
    }elseif($action=="mientrung"){
        $url_search = Yii::app()->params["http_url"].'/mien-trung/xs'.$province["code"].'-'.$province["alias"].'';
        $sc = '8212';
        $region = 'MT';
        $title_h2 = "miền trung";
        $title_region = "Kết quả xổ số miền trung";
        $url_region = Url::createUrl("result/kqMientrung");
        list($date_result,$time_live) = Common::getDataProvinceLive("mt",$province,$time);
        list($date_next,$time_live_next) = Common::getDataProvinceLive("mt",$province,$time);
        $template = "load_kq_tinh";
        $url_load_kq_province = '/ttkq/mien-trung/xosome_'.$province["id"].'.html';
    }else{
        $url_search = Yii::app()->params["http_url"].'/mien-bac/xs'.$province["code"].'-'.$province["alias"].'';
        $sc = '8012';
        $region = 'MB';
        $title_h2 = "miền bắc";
        $title_region = "Kết quả xổ số miền bắc";
        $url_region = Url::createUrl("result/kqMienbac");
        list($date_result,$time_live) = Common::getDataProvinceLive("mb",$province,$time);
        list($date_next,$time_live_next) = Common::getDataProvinceLive("mb",$province,$time);
        $template = "application.views.home.load_kqmb";
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
                if(empty($first_data["ngay_quay"]) || $first_data["ngay_quay"]!=date('Y-m-d')){
                    $tuong_thuat = 1;
                }
            }

        }
    }
?> 

<div class="col-l">
    <div class="box info-city">
        <h1 class="title-bor mag0"><strong>XS<?php echo strtoupper($province["code"])?> - SX<?php echo strtoupper($province["code"])?> - Xổ số <?php echo $province["name"] ?></strong></h1>

    </div>

    <div class="box">
        <ul class="list-dot-red linkcol2">
            <?php 
                $j=0;
                foreach($data as $value){
                    $j++;
                    if($j<=4){
                        $link_date = Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($value["ngay_quay"])),"thang"=>date('m',strtotime($value["ngay_quay"])),"nam"=>date('Y',strtotime($value["ngay_quay"]))));
                    ?>
                    <li>
                        <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                        <a title="KQXS <?php echo $province["name"]?> ngày <?php echo date('d/m/Y',strtotime($value["ngay_quay"]))?>" href="<?php echo $link_date?>">KQXS <?php echo $province["name"]?> ngày <?php echo date('d/m/Y',strtotime($value["ngay_quay"]))?></a>
                    </li> 
                    <?php }
            }?>
        </ul>
    </div>
    <div class="box-kq">   
        <div class="box">
            <div class="title-bor magb10">
                <div class="opt_date opt_date_full">
                    <select id="ngay">
                        <?php for($i=1;$i<=31;$i++){?>
                            <option value="<?php echo $i?>" <?php echo date("d")==$i ? 'selected':''?>>Ngày <?php echo $i?></option>
                            <?php }?>
                    </select>
                    <select id="thang">
                        <?php for($i=1;$i<=12;$i++){?>
                            <option value="<?php echo $i?>" <?php echo date("m")==$i ? 'selected':''?>>Tháng <?php echo $i?></option>
                            <?php }?>
                    </select>
                    <select id="nam">
                        <?php for($i=2010;$i<=date('Y');$i++){?>
                            <option value="<?php echo $i?>" <?php echo date("Y")==$i ? 'selected':''?>>Năm <?php echo $i?></option>
                            <?php }?>
                    </select>
                    <button class="bt-red" type="button" onclick="searchKQ('<?php echo $url_search;?>','<?php echo $province["id"];?>')"><strong>Tìm</strong></button>
                </div>
            </div>
            <?php $this->renderPartial("application.views.layouts.adsend"); ?>
            <?php if($tuong_thuat==1){?>
                <div class="tit-mien txt-center clearfix">
                    <h2 class="s18">Tường Thuật Xổ số <?php echo $province["name"] ?> Trực Tiếp ngày <?php echo date("d/m/Y")?></h2>
                </div>
                <div class="col-2 clearfix" id="load_kq_tinh_0">
                </div>
                <?php }?>
            <?php 
                $i=0;
                foreach($data as $value){
                    $i++;
                    $date = getdate(strtotime($value["ngay_quay"]));
                    $day = Common::getWeekDay($date["wday"]);
                ?>
                <div class="tit-mien txt-center clearfix">
                    <h2 class="s18">XS<?php echo strtoupper($province["code"])?> - Xổ số <?php echo $province["name"] ?> ngày <?php echo date("d/m/Y",strtotime($value["ngay_quay"]))?>(<?php echo $day["label"]?>)</h2>
                </div>

                <div class="col-2 clearfix" id="load_kq_tinh_<?php echo $i?>">
                    <?php $this->renderPartial($template,array("data"=>$value,"loto"=>$loto[$value["id"]],"province"=>$province))?>
                </div>
                <?php if($i==1){?>
                    <?php $this->renderPartial("application.views.layouts.adsend"); ?>
                    <?php }?>

                <?php }?>

        </div>
        <?php if(!empty($province["content_xsme"])){?>
            <div class="box pad5">
                <?php echo $province["content_xsme"] ?>    
            </div>
            <?php }?>
        <?php if($max_page >1){?>
            <div class="paging txt-right pad10-5">
                <?php       
                    $path = $url_action_form;
                    $path = str_replace(".html","",$path);
                    echo Paging::showPageNavigation($page,$max_page,$path."/");
                ?>
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
                    $("#load_kq_tinh_0").html(msg);
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
        <?php if($tuong_thuat==1){?>
            loadProvince();
            setInterval(
                function(){
                    loadProvince();
                },1000
            ); 

            <?php }?>
        
    }); 
</script>