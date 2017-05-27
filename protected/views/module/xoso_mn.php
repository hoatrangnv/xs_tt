<?php
    $regions = LoadConfig::$region;
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $detect = new MobileDetect();

    $date = getdate(time());
    $day = Common::getWeekDay($date["wday"]);
    $thu = "thu".$day["id"];
    $data = Provinces::getAllData();    
    $provinces = Common::multiSort($data[3],$thu,1);

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
    <h2><strong>Xổ số miền nam</strong></h2>

    <ul>
        <?php foreach($provinces as $key=>$value){
                $live = "";
                foreach($value["live"] as $wday){
                    $live .= LoadConfig::$string_wday[$wday].', ';
                }
                $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));  
            ?>
            <li>
                <img width="10" height="10" alt="Kết quả xổ số <?php echo $value["name"]?>" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                <a title="Kết quả xổ số <?php echo $value["name"]?>" href="<?php echo $url_province;?>"><strong><?php echo $value["name"]?></strong><?php echo rtrim($live,", ") != '' ? ' - '.rtrim($live,", ") : '';?></a>
            </li>
        <?php }?>   
    </ul>
</div>
