<?php
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $ngay_quay = isset($data["ngay_quay"]) ? $data["ngay_quay"] : date('Y-m-d',time());
    $date = getdate(strtotime($ngay_quay));
    $day = Common::getWeekDay($date["wday"]);
    if(isset($x) && isset($y)){
        $data["giai_tam"] = Common::getVitriBoso("giai_tam",$data["giai_tam"],$x,$y,$province["region"]);
        $data["giai_bay"] = Common::getVitriBoso("giai_bay",$data["giai_bay"],$x,$y,$province["region"]);
        $data["giai_sau_1"] = Common::getVitriBoso("giai_sau_1",$data["giai_sau_1"],$x,$y,$province["region"]);
        $data["giai_sau_2"] = Common::getVitriBoso("giai_sau_2",$data["giai_sau_2"],$x,$y,$province["region"]);
        $data["giai_sau_3"] = Common::getVitriBoso("giai_sau_3",$data["giai_sau_3"],$x,$y,$province["region"]);
        $data["giai_nam"] = Common::getVitriBoso("giai_nam",$data["giai_nam"],$x,$y,$province["region"]);
        $data["giai_tu_1"] = Common::getVitriBoso("giai_tu_1",$data["giai_tu_1"],$x,$y,$province["region"]);
        $data["giai_tu_2"] = Common::getVitriBoso("giai_tu_2",$data["giai_tu_2"],$x,$y,$province["region"]);
        $data["giai_tu_3"] = Common::getVitriBoso("giai_tu_3",$data["giai_tu_3"],$x,$y,$province["region"]);
        $data["giai_tu_4"] = Common::getVitriBoso("giai_tu_4",$data["giai_tu_4"],$x,$y,$province["region"]);
        $data["giai_tu_5"] = Common::getVitriBoso("giai_tu_5",$data["giai_tu_5"],$x,$y,$province["region"]);
        $data["giai_tu_6"] = Common::getVitriBoso("giai_tu_6",$data["giai_tu_6"],$x,$y,$province["region"]);
        $data["giai_tu_7"] = Common::getVitriBoso("giai_tu_7",$data["giai_tu_7"],$x,$y,$province["region"]);
        $data["giai_ba_1"] = Common::getVitriBoso("giai_ba_1",$data["giai_ba_1"],$x,$y,$province["region"]);
        $data["giai_ba_2"] = Common::getVitriBoso("giai_ba_2",$data["giai_ba_2"],$x,$y,$province["region"]);
        $data["giai_nhi"] = Common::getVitriBoso("giai_nhi",$data["giai_nhi"],$x,$y,$province["region"]);
        $data["giai_nhat"] = Common::getVitriBoso("giai_nhat",$data["giai_nhat"],$x,$y,$province["region"]);
        $data["giai_dacbiet"] = Common::getVitriBoso("giai_dacbiet",$data["giai_dacbiet"],$x,$y,$province["region"]);
    }
    if($province["region"]==3){    
        $title_rg = "miền nam";
        $link_wday = Url::createUrl("result/miennamWday",array("wday"=>$day["alias"]));
        $link_provine = Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
    }elseif($province["region"]==2){    
        $title_rg = "miền trung";
        $link_wday = Url::createUrl("result/mientrungWday",array("wday"=>$day["alias"]));
        $link_provine = Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
    }else{                   
        $title_rg = "miền bắc";
        $link_wday = Url::createUrl("result/mienbacWday",array("wday"=>$day["alias"]));
        $link_provine = Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
    }
    $link_day = Url::createUrl("result/day",array("ngay_quay"=>date('d-m-Y',strtotime($ngay_quay))));
?>
<div class="<?php echo !isset($del_col420) ? 'col420':''?>">
    <ul class="gr-yellow" style="text-align: center;">
        <?php if($control=="result" && in_array($action,array("miennam","mientrung"))){?>
            <li style="width: 100%"><strong>Xổ số <?php echo $province["name"];?></strong></li>
            <?php }else{?>
            <li style="width: 100%"><a title="Xổ số <?php echo $province["name"];?>" href="<?php echo $link_provine;?>"><strong>Xổ số <?php echo $province["name"];?></strong></a></li>
            <?php }?>
    </ul>
    <ul class="list-kqmb city-mn">
        <li class="bg_yellow pad5 clearfix">
            <label class="fl clred"><strong>Giải tám</strong></label>
            <div class="aprize <?php echo !isset($del_clred) ? 'clred':''?> s24"><span><strong class="<?php echo $data["giai_tam"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tam"];?></strong></span></div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl"><strong>Giải bảy</strong></label>
            <div class="aprize"><span><strong class="<?php echo $data["giai_bay"] == "" ? "imgloadig":''?>"><?php echo $data["giai_bay"];?></strong></span></div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="fl"><strong>Giải sáu</strong></label>
            <div class="clearfix">
                <span class="fl percent-33"><strong class="<?php echo $data["giai_sau_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_sau_1"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_sau_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_sau_2"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_sau_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_sau_3"];?></strong></span>
            </div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl"><strong>Giải năm</strong></label>
            <div align="center"><span><strong class="<?php echo $data["giai_nam"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam"];?></strong></span></div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="fl"><strong>Giải tư</strong></label>
            <div class="clearfix" align="center">
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_1"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_2"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_3"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_4"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_4"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_tu_5"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_5"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_tu_6"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_6"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_tu_7"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_7"];?></strong></span>
            </div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl"><strong>Giải ba</strong></label>
            <div class="clearfix">
                <span class="fl percent-50"><strong class="<?php echo $data["giai_ba_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_1"];?></strong></span>
                <span class="fl percent-50"><strong class="<?php echo $data["giai_ba_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_2"];?></strong></span>
            </div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="fl"><strong>Giải nhì</strong></label>
            <div align="center">
                <span><strong class="<?php echo $data["giai_nhi"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nhi"];?></strong></span>
            </div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl"><strong>Giải nhất</strong></label>
            <div align="center">
                <span><strong class="<?php echo $data["giai_nhat"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nhat"];?></strong></span>
            </div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="special fl"><strong>Đặc biệt</strong></label>
            <div align="center" class="<?php echo !isset($del_clred) ? 'clred':''?> s24">
                <span><strong class="<?php echo $data["giai_dacbiet"] == "" ? "imgloadig":''?>"><?php echo $data["giai_dacbiet"];?></strong></span>
            </div>
        </li>
    </ul>
</div>
<?php if($loto){?>
    <div class="col125">
        <div class="clearfix header">
            <span class="in-block"><strong>Đầu</strong></span>
            <span class="in-block"><strong>Đuôi</strong></span>
        </div>
        <ul class="first-last">
            <?php for($i=0;$i<=9;$i++){
                    $boso = "";
                    for($j=0;$j<count($loto);$j++){
                        if(substr($loto[$j],0,1)==$i){
                            $boso .= substr($loto[$j],1).',';
                        }
                    }
                ?>
                <li class="bg_f9 clearfix">
                    <label class="fl"><strong><?php echo $i;?></strong></label>
                    <div class="fl"><?php echo trim($boso,",");?></div>
                </li>
                <?php }?>
        </ul>
    </div>
    <?php }?>