<?php
    $regions = LoadConfig::$region;
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $day = date('d-m-Y');
    $data = Provinces::getDataInDay($day,1);
?>
<div class="box xshomnay">
    <div class="titstrong"><strong>Các tỉnh mở thưởng ngày hôm nay</strong></div>
    <ul class="list-dot-red clearfix">
        <?php foreach($data as $key=>$value){
            if($value["region"] != 1){
                if($value["region"]==3){
                    $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));
                }elseif($value["region"]==2){
                    $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));
                }else{
                    $url_province = Url::createUrl("result/mienbac",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));
                }  
            ?>
            <li>
                <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="XS <?php echo $value["name"]?>" href="<?php echo $url_province;?>">XS <strong><?php echo $value["name"]?></strong></a></li>
            <?php }else{?>
            
            <li>
                <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="XS Miền Bắc" href="<?php echo Url::createUrl("result/kqMienbac");?>">XS <strong>Miền Bắc</strong></a></li>
            <?php }
        }?>
    </ul>
</div>