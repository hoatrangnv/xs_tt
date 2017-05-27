<?php
    $control = Yii::app()->controller->id;
    $ngay_quay = isset($data["ngay_quay"]) ? $data["ngay_quay"] : date('Y-m-d',time());
    $date = getdate(strtotime($ngay_quay));
    $day = Common::getWeekDay($date["wday"]);
    if(isset($x) && isset($y)){
        $data["giai_dacbiet"] = Common::getVitriBoso("giai_dacbiet",$data["giai_dacbiet"],$x,$y,1);
        $data["giai_nhat"] = Common::getVitriBoso("giai_nhat",$data["giai_nhat"],$x,$y,1);
        $data["giai_nhi_1"] = Common::getVitriBoso("giai_nhi_1",$data["giai_nhi_1"],$x,$y,1);
        $data["giai_nhi_2"] = Common::getVitriBoso("giai_nhi_2",$data["giai_nhi_2"],$x,$y,1);
        $data["giai_ba_1"] = Common::getVitriBoso("giai_ba_1",$data["giai_ba_1"],$x,$y,1);
        $data["giai_ba_2"] = Common::getVitriBoso("giai_ba_2",$data["giai_ba_2"],$x,$y,1);
        $data["giai_ba_3"] = Common::getVitriBoso("giai_ba_3",$data["giai_ba_3"],$x,$y,1);
        $data["giai_ba_4"] = Common::getVitriBoso("giai_ba_4",$data["giai_ba_4"],$x,$y,1);
        $data["giai_ba_5"] = Common::getVitriBoso("giai_ba_5",$data["giai_ba_5"],$x,$y,1);
        $data["giai_ba_6"] = Common::getVitriBoso("giai_ba_6",$data["giai_ba_6"],$x,$y,1);
        $data["giai_tu_1"] = Common::getVitriBoso("giai_tu_1",$data["giai_tu_1"],$x,$y,1);
        $data["giai_tu_2"] = Common::getVitriBoso("giai_tu_2",$data["giai_tu_2"],$x,$y,1);
        $data["giai_tu_3"] = Common::getVitriBoso("giai_tu_3",$data["giai_tu_3"],$x,$y,1);
        $data["giai_tu_4"] = Common::getVitriBoso("giai_tu_4",$data["giai_tu_4"],$x,$y,1);
        $data["giai_nam_1"] = Common::getVitriBoso("giai_nam_1",$data["giai_nam_1"],$x,$y,1);
        $data["giai_nam_2"] = Common::getVitriBoso("giai_nam_2",$data["giai_nam_2"],$x,$y,1);
        $data["giai_nam_3"] = Common::getVitriBoso("giai_nam_3",$data["giai_nam_3"],$x,$y,1);
        $data["giai_nam_4"] = Common::getVitriBoso("giai_nam_4",$data["giai_nam_4"],$x,$y,1);
        $data["giai_nam_5"] = Common::getVitriBoso("giai_nam_5",$data["giai_nam_5"],$x,$y,1);
        $data["giai_nam_6"] = Common::getVitriBoso("giai_nam_6",$data["giai_nam_6"],$x,$y,1);
        $data["giai_sau_1"] = Common::getVitriBoso("giai_sau_1",$data["giai_sau_1"],$x,$y,1);
        $data["giai_sau_2"] = Common::getVitriBoso("giai_sau_2",$data["giai_sau_2"],$x,$y,1);
        $data["giai_sau_3"] = Common::getVitriBoso("giai_sau_3",$data["giai_sau_3"],$x,$y,1);
        $data["giai_bay_1"] = Common::getVitriBoso("giai_bay_1",$data["giai_bay_1"],$x,$y,1);
        $data["giai_bay_2"] = Common::getVitriBoso("giai_bay_2",$data["giai_bay_2"],$x,$y,1);
        $data["giai_bay_3"] = Common::getVitriBoso("giai_bay_3",$data["giai_bay_3"],$x,$y,1);
        $data["giai_bay_4"] = Common::getVitriBoso("giai_bay_4",$data["giai_bay_4"],$x,$y,1);
    }
    $link_province = Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
?>
<div class="<?php echo !isset($del_col420) ? 'col420':''?>">
    <ul class="gr-yellow" style="text-align: center;">
        <li style="width: 100%"><a title="XSMB - Xổ số <?php echo $province["name"];?>" href="<?php echo $link_province;?>"><strong>XSMB - Xổ số <?php echo $province["name"];?></strong></a></li>
    </ul>
    <ul class="list-kqmb">
        <li class="bg_yellow pad5 clearfix">
            <label class="special fl">Đặc biệt</label>
            <div class="aprize <?php echo !isset($del_clred) ? 'clred':''?> s24"><span><strong class="<?php echo $data["giai_dacbiet"] == "" ? "imgloadig":''?>"><?php echo $data["giai_dacbiet"];?></strong></span></div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl">Giải nhất</label>
            <div class="aprize"><span><strong class="<?php echo $data["giai_nhat"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nhat"];?></strong></span></div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="fl">Giải nhì</label>
            <div class="clearfix">
                <span class="fl percent-50"><strong class="<?php echo $data["giai_nhi_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nhi_1"];?></strong></span>
                <span class="fl percent-50"><strong class="<?php echo $data["giai_nhi_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nhi_2"];?></strong></span>

            </div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl">Giải ba</label>
            <div class="clearfix">
                <span class="fl percent-33"><strong class="<?php echo $data["giai_ba_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_1"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_ba_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_2"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_ba_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_3"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_ba_4"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_4"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_ba_5"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_5"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_ba_6"] == "" ? "imgloadig":''?>"><?php echo $data["giai_ba_6"];?></strong></span>
            </div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="fl">Giải tư</label>
            <div class="clearfix">
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_1"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_2"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_3"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_tu_4"] == "" ? "imgloadig":''?>"><?php echo $data["giai_tu_4"];?></strong></span>
            </div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl">Giải năm</label>
            <div class="clearfix">
                <span class="fl percent-33"><strong class="<?php echo $data["giai_nam_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam_1"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_nam_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam_2"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_nam_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam_3"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_nam_4"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam_4"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_nam_5"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam_5"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_nam_6"] == "" ? "imgloadig":''?>"><?php echo $data["giai_nam_6"];?></strong></span>
            </div>
        </li>
        <li class="bg_yellow pad5 clearfix">
            <label class="fl">Giải sáu</label>
            <div class="clearfix">
                <span class="fl percent-33"><strong class="<?php echo $data["giai_sau_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_sau_1"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_sau_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_sau_2"];?></strong></span>
                <span class="fl percent-33"><strong class="<?php echo $data["giai_sau_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_sau_3"];?></strong></span>

            </div>
        </li>
        <li class="pad5 clearfix">
            <label class="fl">Giải bảy</label>
            <div class="clearfix">
                <span class="fl percent-25"><strong class="<?php echo $data["giai_bay_1"] == "" ? "imgloadig":''?>"><?php echo $data["giai_bay_1"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_bay_2"] == "" ? "imgloadig":''?>"><?php echo $data["giai_bay_2"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_bay_3"] == "" ? "imgloadig":''?>"><?php echo $data["giai_bay_3"];?></strong></span>
                <span class="fl percent-25"><strong class="<?php echo $data["giai_bay_4"] == "" ? "imgloadig":''?>"><?php echo $data["giai_bay_4"];?></strong></span>
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
   <?php if($control=="home"){?> 
    <div class="loto-now">
        <h2>Loto trực tiếp</h2>
        <ul>
            <?php 
                $number_display = 0;
                for($i=0;$i<count($loto);$i++){
                    if($loto[$i]==substr($data["giai_dacbiet"],-2,2)){
                        $class = "clred";
                        $number_display++;
                    }else{
                        $class = "";
                    }
                ?>
                <li class="in-block gr-gray"><strong class="<?php echo $number_display==1 ? $class:''?>"><?php echo $loto[$i]?></strong></li> 
                <?php }?>
        </ul>
    </div>
    <?php }?>
    <?php }?>