<?php
    $time = time()-86400;
    if(!isset($region) || $region <=0){
        $region = 1;
    }
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $day = date('d-m-Y',$time);
    $all_data = Provinces::getDataInDay($day);
    
    $data = $all_data[$region];

?>

<div class="box">
    <div class="titstrong"><strong>Các tỉnh mở thưởng ngày hôm qua</strong></div>
    <ul class="list-dot-red linkcol2">
        <?php foreach($data as $key=>$value){
                if($value["region"]==3){
                    $title = "KQXS ".$value["name"]." ngày ".date('d-m-Y',$time);
                    $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));
                }elseif($value["region"]==2){
                    $title = "KQXS ".$value["name"]." ngày ".date('d-m-Y',$time);
                    $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));
                }else{
                    $title = "KQXS ".$value["name"]." ngày ".date('d-m-Y',$time);
                    $url_province = Url::createUrl("result/mienbac",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]));
                }  
            ?>
            <li>
                <img width="6" height="6" alt="<?php echo $title;?>" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                <a title="<?php echo $title;?>" href="<?php echo $url_province?>"><?php echo $title;?></a>
            </li>
            <?php }?>
    </ul>
</div>

