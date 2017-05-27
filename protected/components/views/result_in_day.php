<?php
    $regions = LoadConfig::$region;
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $detect = new MobileDetect();
?>
<script type="text/javascript">
    function showPredict(region){
        if($("."+region+"_predic_0").css("display")=="none"){
            $(".cl_predict").removeClass("arr-top");
            $(".cl_predict").addClass("arr-btt");
            $("."+region+"_predic_0").show(); 
        }else{
            $(".cl_predict").removeClass("arr-btt");
            $(".cl_predict").addClass("arr-top");
            $("."+region+"_predic_0").hide();
        }
    }
    function showProvince(region){
        if($("."+region+"_p_0").css("display")=="none"){
            $(".cl_region").removeClass("arr-top");
            $(".cl_region").addClass("arr-btt");
            $("."+region+"_p_0").show(); 
        }else{
            $(".cl_region").removeClass("arr-btt");
            $(".cl_region").addClass("arr-top");
            $("."+region+"_p_0").hide();
        }
    }
</script>

<div class=" <?php echo $control=="statistic" ? 'col-right':'col-center'?>">
    <div class="box">
        <?php if($control=="tuvi"){?>
            <div class="conten-right">
                <h3><strong>Tử Vi Trọn Đời</strong></h3>
                <ul class="lottery-now">
                    <?php
                        $i =0;
                        foreach(LoadConfig::$tuvi_cat as $key=>$value){
                            $i++;
                        ?>
                        <li class="<?php echo $i==count(LoadConfig::$tuvi_cat) ? 'nobor' :''?>">
                            <span class="ic"></span>
                            <a href="<?php echo Url::createUrl("tuvi/index",array("alias"=>$value["alias"],"content_id"=>$key))?>" title="<?php echo $value["name"];?>"><?php echo $value["name"];?></a>
                        </li>
                        <?php }?>
                </ul>
            </div>
            <div align="center">
                <?php
                    if(!$detect->isMobile()){
                    ?>
                    <style>
                        .hdc-csi_right { width: 160px; height: 600px; }   
                    </style>
                    <!-- hdc-csi -->
                    <ins class="adsbygoogle hdc-csi_right"
                        style="display:inline-block"
                        data-ad-client="ca-pub-3084353470359421"
                        data-ad-slot="3704218993"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <?php
                    }
                ?>
            </div>
            <?php }elseif($control=="xemtuong"){?>
            <div class="conten-right">
                <h3><strong>Xem Tướng</strong></h3>
                <ul class="lottery-now">
                    <?php
                        $i =0;
                        foreach(LoadConfig::$xemtuong_cat as $key=>$value){
                            $i++;
                        ?>
                        <li class="<?php echo $i==count(LoadConfig::$xemtuong_cat) ? 'nobor' :''?>">
                            <span class="ic"></span>
                            <a href="<?php echo Url::createUrl("xemtuong/index",array("alias"=>$value["alias"],"content_id"=>$key))?>" title="<?php echo $value["name"];?>"><?php echo $value["name"];?></a>
                        </li>
                        <?php }?>
                </ul>
            </div>
            <?php }?>
        <?php if($control=="soicau"){
                if($action=="dacbiet"){
                    $title_soicau = "đặc biệt";
                }elseif($action=="index"){
                    $title_soicau = "lô tô"; 
                }else{
                    $title_soicau = "hai nháy"; 
                }
            ?>    
            <div class="conten-right">
                <h3><strong>Soi cầu kết quả</strong></h3>
                <ul class="expected">
                    <?php 
                        $i = 0;
                        foreach($regions_rule as $rg){
                            if($rg=="mn"){
                                $param_rg = "mien-nam";
                            }elseif($rg=="mt"){
                                $param_rg = "mien-trung";
                            }else{
                                $param_rg = "mien-bac"; 
                            }
                            $i++;
                        ?>
                        <li <?php echo $i==3 ? 'class="nobor"' : ''?>>
                            <ul>
                                <?php
                                    if($rg !="mb"){ 
                                        foreach($data[$regions[$rg]["id"]] as $key=>$value){?>
                                        <li class="<?php echo $rg;?>_predic_<?php echo $value[$thu];?>" style="display: <?php echo $value[$thu]==1 ? 'block':'none'?>;">
                                            <img width="10" height="10" alt="Soi cầu <?php echo $title_soicau." ".$value["name"];?>" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                                            <a title="Soi cầu <?php echo $title_soicau." ".$value["name"];?>" href="<?php echo Url::createUrl("soicau/".$action,array("province_name"=>$value["alias"],"province_id"=>$value["id"]));?>">Soi cầu <?php echo $title_soicau;?> <strong><?php echo $value["name"]?></strong></a>
                                        </li>
                                        <?php }
                                }?>     
                                <li class="last"><a class="ic" title="" href="<?php echo Url::createUrl("soicau/".$action,array("region"=>$param_rg))?>">Soi cầu <?php echo $title_soicau;?> <strong class="cl-green"><?php echo $regions[$rg]["name"];?></strong></a></li>
                            </ul>
                        </li>
                        <?php }?>
                </ul>
            </div>
            <?php }else{?>
            <?php if($control!="tuvi"){?>
                <div class="conten-right">
                    <h3><strong>Dự đoán kết quả xổ số</strong></h3>
                    <ul class="expected">
                        <?php 
                            $i = 0;
                            foreach($regions_rule as $rg){
                                $i++;
                            ?>
                            <li <?php echo $i==3 ? 'class="nobor"' : ''?>>
                                <ul>

                                    <?php foreach($data[$regions[$rg]["id"]] as $key=>$value){
                                            $alias_region = LoadConfig::$label_alias[$value["region"]];
                                            $link_dudoan = Url::createUrl("dudoan/list",array("alias_region"=>$alias_region,"province_name"=>$value["alias"],"province_id"=>$value["id"]));
                                        ?>
                                        <li class="<?php echo $rg;?>_predic_<?php echo $value[$thu];?>" style="display: <?php echo $value[$thu]==1 ? 'block':'none'?>;">
                                            <img width="10" height="10" alt="Dự đoán xổ số <?php echo $value["name"]?>" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
                                            <a title="Dự đoán xổ số <?php echo $value["name"]?>" href="<?php echo $link_dudoan;?>">Dự đoán xổ số <strong><?php echo $value["name"]?></strong></a>
                                        </li>
                                        <?php }?>

                                    <li class="last">
                                        <span  class="cl_predict arr-top"></span>
                                        <a rel="nofollow" title="" href="javascript:void(0)" onclick="showPredict('<?php echo $rg;?>')">Xem dự đoán các tỉnh <strong class="cl-green"><?php echo $regions[$rg]["name"];?></strong></a>
                                    </li>
                                </ul>
                            </li>
                            <?php }?>
                    </ul>
                </div>
                <?php }?>
            <?php }?>
        <!--<div class="pad5 ad-ased">
        <img src="<?php echo Yii::app()->params["static_url"]?>/demo/ad-ased.png">
        </div> -->
        <?php if($control!="tuvi"){?>
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
            <?php }?>
        <?php if($control!="tuvi"){?>
            <div class="conten-right">
                <h2><strong>Kết quả xổ số <?php echo $regions[$region_id]["name"]?></strong></h2>
                <ul class="kq-day">
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"thu-hai"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> thứ hai">Xổ số <?php echo $regions[$region_id]["name"]?> thứ hai</a></li>
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"thu-ba"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> thứ ba">Xổ số <?php echo $regions[$region_id]["name"]?> thứ ba</a></li>
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"thu-tu"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> thứ tư">Xổ số <?php echo $regions[$region_id]["name"]?> thứ tư</a></li>
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"thu-nam"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> thứ năm">Xổ số <?php echo $regions[$region_id]["name"]?> thứ năm</a></li>
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"thu-sau"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> thứ sáu">Xổ số <?php echo $regions[$region_id]["name"]?> thứ sáu</a></li>
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"thu-bay"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> thứ bảy">Xổ số <?php echo $regions[$region_id]["name"]?> thứ bảy</a></li>
                    <li class="nobor"><a class="ic" title="" href="<?php echo Url::createUrl("result/".$regions[$region_id]["action"]."Wday",array("wday"=>"chu-nhat"))?>" title="Xổ số <?php echo $regions[$region_id]["name"]?> chủ nhật">Xổ số <?php echo $regions[$region_id]["name"]?> chủ nhật</a></li>
                </ul>
            </div>
            <?php }?>
       
    </div>

</div>
