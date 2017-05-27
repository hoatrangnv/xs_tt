<?php
    $regions = LoadConfig::$region;
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
?>
<?php if(!in_array($action,array("mienbac","miennam","mientrung"))){?>
<div class="kq-full box bor-1">
    <ul class="clearfix">
        <li>
            <div class="title"><strong>Kết quả xổ số <?php echo date("d-m-Y",time())?></strong></div>
            <ul>
                <?php  foreach($regions_rule as $rg){ 
                        if($rg=="mn"){
                            $url_region = Url::createUrl("result/kqMiennam");
                        }elseif($rg=="mt"){
                            $url_region = Url::createUrl("result/kqMientrung");
                        }else{
                            $url_region = Url::createUrl("result/kqMienbac");
                        }
                    ?>
                    <li>
                        <div><a class="clred" title="Xổ số <?php echo $regions[$rg]["name"];?>" href="<?php echo $url_region;?>"><strong>Xổ số <?php echo $regions[$rg]["name"];?></strong></a></div>
                        <?php 
                            foreach($data[$regions[$rg]["id"]] as $key=>$value){
                                if($rg=="mn"){
                                    $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                                }elseif($rg=="mt"){
                                    $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                                }else{
                                    $url_province = Url::createUrl("result/mienbac",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                                }
                            ?>
                            <p>
                                <a title="Xổ số <?php echo $value["name"]?>" href="<?php echo $url_province;?>">Xổ số <strong><?php echo $value["name"]?></strong></a>
                                <?php if(date("H",time())==$regions[$rg]["hour_live"]){
                                    if(date("i",time()) <=31){
                                    ?>
                                    <img width="15" height="15" class="mag-l5" alt="Tường thuật kết quả xổ số <?php echo $value["name"]?>" src="<?php echo Yii::app()->params["static_url"]?>/images/loading1.gif">
                                    <?php }else{?>
                                    <img width="15" height="15" class="mag-l5" alt="Trực tiếp kết quả xổ số <?php echo $value["name"]?>" src="<?php echo Yii::app()->params["static_url"]?>/images/ic-check.png">
                                    <?php }
                                }?>
                            </p>
                            <?php }?>
                    </li>
                    <?php }?>
            </ul>
        </li>
        <li>
            <div class="title"><strong>Soi cầu loto</strong></div>
            <ul>
                <?php  foreach($regions_rule as $rg){ 
                        if($rg=="mn"){
                            $url_region = Url::createUrl("soicau/index",array("region"=>"mien-nam"));
                        }elseif($rg=="mt"){
                            $url_region = Url::createUrl("soicau/index",array("region"=>"mien-trung"));
                        }else{
                            $url_region = Url::createUrl("soicau/index",array("region"=>"mien-bac"));
                        }
                    ?>
                    <li>
                        <div><a class="clred" title="Soi cầu loto <?php echo $regions[$rg]["name"];?>" href="<?php echo $url_region;?>"><strong>Soi cầu loto <?php echo $regions[$rg]["name"];?></strong></a></div>
                        <?php foreach($data[$regions[$rg]["id"]] as $key=>$value){
                                if($rg=="mb"){
                                    $link_gan = $url_region;
                                }else{
                                    $link_gan = Url::createUrl("soicau/index",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                                }
                            ?>   
                            <p>
                                <a title="Soi cầu loto <?php echo $rg=="mb" ? Common::getProvinceMB()  : $value["name"]?>" href="<?php echo $link_gan?>">Soi cầu loto <strong><?php echo $rg=="mb" ? Common::getProvinceMB()  : $value["name"]?></strong></a>
                            </p>
                            <?php }?>
                    </li>
                    <?php }?>
            </ul>
        </li>
        <li>
            <div class="title"><strong>Thống kê loto</strong></div>
            <ul>
                <?php  foreach($regions_rule as $rg){
                        if($rg=="mn"){
                            $url_region = Url::createUrl("statistic/chukyLoto",array("region"=>"mien-nam"));
                        }elseif($rg=="mt"){
                            $url_region = Url::createUrl("statistic/chukyLoto",array("region"=>"mien-trung"));
                        }else{
                            $url_region = Url::createUrl("statistic/chukyLoto",array("region"=>"mien-bac"));
                        }
                    ?>
                    <li>
                        <div><a class="clred" title="Loto <?php echo $regions[$rg]["name"];?>" href="<?php echo $url_region;?>"><strong>Loto <?php echo $regions[$rg]["name"];?></strong></a></div>
                        <?php foreach($data[$regions[$rg]["id"]] as $key=>$value){
                                if($rg=="mb"){
                                    $link_loto = $url_region;
                                }else{
                                    $link_loto = Url::createUrl("statistic/chukyLoto",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                                }
                            ?>
                            <p>
                                <a title="Loto <?php echo $rg=="mb" ? Common::getProvinceMB()  : $value["name"]?>" href="<?php echo $link_loto;?>">Loto <strong><?php echo $rg=="mb" ? Common::getProvinceMB()  : $value["name"]?></strong></a>
                            </p>
                            <?php }?>
                    </li>
                    <?php }?>
            </ul>
        </li>
    </ul>
    </div>
<?php }?>