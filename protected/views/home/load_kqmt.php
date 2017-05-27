<?php
    $date = getdate(strtotime($ngay_quay));
    $day = Common::getWeekDay($date["wday"]);
    $control = Yii::app()->controller->id;
?>
<ul class="gr-yellow clearfix">
    <li class="first">
        <strong><?php echo $day["label"]?></strong>
        <br />
        <span class="s12"><?php echo date('d-m-Y',strtotime($ngay_quay))?></span>
    </li>
    <?php foreach($provinces as $value){?>
        <li>
            <a title="Xổ số <?php echo $value["name"];?>" href="<?php echo Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]))?>" title="">
                <strong><?php echo $value["name"];?></strong>
            </a>
            <br />
            <span class="s12">Mã: <?php echo strtoupper($value["code"]);?></span>
        </li>
        <?php }?>
</ul>
<ul class="list-col">
    <li class="pad5 clearfix">
        <label class="cl-green fl">Giải tám</label>
        <div class="cl-green fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tam"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tam"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="bg_yellow pad5 clearfix">
        <label class="fl">Giải bảy</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_bay"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_bay"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="pad5 clearfix">
        <label class="fl">Giải sáu</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_sau_1"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_sau_1"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_sau_2"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_sau_2"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_sau_3"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_sau_3"]?></strong>
                </span>
                <?php }?>        
        </div>
    </li>
    <li class="bg_yellow pad5 clearfix">
        <label class="fl">Giải năm</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_nam"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_nam"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="pad5 clearfix">
        <label class="fl">Giải tư</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_1"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_1"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_2"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_2"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_3"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_3"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_4"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_4"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_5"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_5"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_6"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_6"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_tu_7"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_tu_7"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="bg_yellow pad5 clearfix">
        <label class="fl">Giải ba</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_ba_1"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_ba_1"]?></strong>
                </span>
                <?php }?>
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_ba_2"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_ba_2"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="pad5 clearfix">
        <label class="fl">Giải nhì</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_nhi"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_nhi"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="bg_yellow pad5 clearfix">
        <label class="fl">Giải nhất</label>
        <div class="fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_nhat"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_nhat"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
    <li class="pad5 clearfix">
        <label class="fl">Đặc biệt</label>
        <div class="special fl clearfix">
            <?php foreach($provinces as $value){?>
                <span class="fl percent-33">
                    <strong class="<?php echo $data[$value["id"]]["giai_dacbiet"]=="" ? "imgloadig":''?>"><?php echo $data[$value["id"]]["giai_dacbiet"]?></strong>
                </span>
                <?php }?>
        </div>
    </li>
</ul>
<?php if($control=="home"){?>
<div class="loto-city dd_<?php echo $ngay_quay;?>" style="display: none;">
    <p class="txt-center s18 cl-org"><strong>Bảng Loto xổ số Miền Trung - Ngày: <?php echo date('d/m/Y',strtotime($ngay_quay))?></strong></p>
    <?php foreach($provinces as $value){?>
        <div class="col125">
            <div class="city-firstl">
                <strong><?php echo $value["name"]?></strong>
            </div>
            <div class="bg_ef clearfix">
                <span class="in-block"><strong>Hàng chục</strong></span>
                <span class="in-block"><strong>Hàng đơn vị</strong></span>
            </div>
            <ul class="first-last">
                <?php for($i=0;$i<=9;$i++){
                        $boso = "";
                        for($j=0;$j<count($loto[$value["id"]]);$j++){
                            if(substr($loto[$value["id"]][$j],0,1)==$i){
                                $boso .= substr($loto[$value["id"]][$j],1).',';
                            }
                        }
                    ?>
                    <li class="clearfix">
                        <label class="fl"><strong><?php echo $i;?></strong></label>
                        <div class="fl"><?php echo trim($boso,",");?></div>
                    </li>
                    <?php }?>
            </ul>
        </div>
        <?php }?>
</div>
<div class="view-loto">
    <p class="txt-right">
        <a style="display: none" id="close_loto_<?php echo $ngay_quay;?>" rel="nofollow" href="javascript:void(0)" title="" onclick="$('.dd_<?php echo $ngay_quay;?>').hide();$('#close_loto_<?php echo $ngay_quay;?>').hide();$('#open_loto_<?php echo $ngay_quay;?>').show();"><span class="ic ic-close"></span><strong>Đóng</strong></a>
        <a id="open_loto_<?php echo $ngay_quay;?>" rel="nofollow" href="javascript:void(0)" title="" onclick="$('.dd_<?php echo $ngay_quay;?>').show();$('#open_loto_<?php echo $ngay_quay;?>').hide();$('#close_loto_<?php echo $ngay_quay;?>').show();"><span class="ic ic-views"></span><strong>Bảng loto 2 số cuối</strong></a>
    </p>
</div>
<?php }?>