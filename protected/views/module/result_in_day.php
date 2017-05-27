<?php
    $regions = LoadConfig::$region;
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $detect = new MobileDetect();

    $date = getdate(time());
    $day = Common::getWeekDay($date["wday"]);
    $thu = "thu".$day["id"];
    $data = Provinces::getAllData();    
    $data[1] = Common::multiSort($data[1],$thu,1);
    $data[2] = Common::multiSort($data[2],$thu,1); 
    $data[3] = Common::multiSort($data[3],$thu,1); 

    $regions_rule = array("mb","mn","mt");
    $region_id = "mb";
    if(in_array($action,array("miennam","miennamWday","kqMiennam")) || date('H',time())==LoadConfig::$region["mn"]["hour_live"]){
        $regions_rule = array("mn","mt","mb");
        $region_id = "mn";
    }elseif(in_array($action,array("mientrung","mientrungWday","kqMientrung")) || date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
        $regions_rule = array("mt","mn","mb");
        $region_id = "mt";
    }
?>
<div class="conten-right">
    <h2><strong>Kết quả xổ số hôm nay</strong></h2>
    <ul class="expected">
        <?php 
            $i = 0;
            foreach($regions_rule as $rg){
                $i++;
            ?>
            <li <?php echo $i==3 ? 'class="nobor"' : ''?>>
                <ul>
                    <?php foreach($data[$regions[$rg]["id"]] as $key=>$value){
                            if($rg=="mn"){
                                $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                            }elseif($rg=="mt"){
                                $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                            }else{
                                $url_province = Url::createUrl("result/mienbac",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                            }  
                        ?>
                        <li class="<?php echo $rg;?>_p_<?php echo $value[$thu];?>" style="display: <?php echo $value[$thu]==1 ? 'block':'none'?>;">
                            <img width="10" height="10" alt="Kết quả xổ số <?php echo $value["name"]?>" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                            <a title="Kết quả xổ số <?php echo $value["name"]?>" href="<?php echo $url_province;?>"><strong><?php echo $value["name"]?></strong></a>
                        </li>
                        <?php }?>   
                    <?php if($rg=="mb"){?>
                        <li class="">
                            <img width="10" height="10" alt="Kết quả xổ số điện toán 123" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                            <a title="Kết quả điện toán 123" href="<?php echo Url::createUrl("result/dientoan123")?>"><strong>Điện toán 123</strong></a>
                        </li>
                        <li class="">
                            <img width="10" height="10" alt="Kết quả xổ số điện toán 6x36" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                            <a title="Kết quả điện toán 6x36" href="<?php echo Url::createUrl("result/dientoan6x36")?>"><strong>Điện toán 6x36</strong></a>
                        </li>
                        <li class="">
                            <img width="10" height="10" alt="Kết quả xổ số thần tài" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                            <a title="Kết quả thần tài" href="<?php echo Url::createUrl("result/thantai")?>"><strong>Thần tài</strong></a>
                        </li>
                        <?php }?>

                    <li class="last">
                        <span  class="cl_region arr-top"></span>
                        <a rel="nofollow" title=""  href="javascript:void(0)" onclick="showProvince('<?php echo $rg;?>')">Xem các tỉnh <strong class="cl-green"><?php echo $regions[$rg]["name"];?></strong></a>
                    </li>
                </ul>
            </li>
            <?php }?>
    </ul>
</div>