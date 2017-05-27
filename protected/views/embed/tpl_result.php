<?php
    $url = Url::createUrl("embed/code",array("bg_color"=>$layout["bg_color"],"tit_color"=>$layout["tit_color"],"db_color"=>$layout["db_color"],"width"=>$layout["width"],"fsize"=>$layout["fsize"]));
    if($province["region"]==3){ 
        $link_province = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));
    }elseif($province["region"]==2){
        $link_province = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));
    }else{
        $link_province = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac");
    }
    ?>
<div class="bwidth" style="background:#f9f5f0;width:<?php echo $layout["width"]?>;padding:5px">
    <div align="right" style="margin-bottom:10px;font-size: <?php echo $layout["fsize"]?>;">
        Ngày: 
        <select onchange="getNewBoxNgay();" id="ngay_quay" style="padding:0;background:none;border:none;font-size: <?php echo $layout["fsize"]?>;">
            <?php foreach($dates as $date){?>
                <option value="<?php echo $date ?>" <?php echo $date==$ngay_quay ? 'selected':''?>><?php echo $date;?></option>
                <?php }?>
        </select>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="">
        <tbody>
            <tr>
                <td width="35" style="text-align:left">
                    <a title="" href="<?php echo Yii::app()->params["base_url"]?>">
                        <img width="30" height="30" alt="logo xoso.me" src="<?php echo Yii::app()->params["static_url"]?>/images/logo-code.png">
                    </a>
                </td>
                <td style="text-align:left;font-size: <?php echo $layout["fsize"]?>;"><strong>Xoso.me</strong><br>
                    <select onchange="getNewBoxHtml();" id="ma_tinh" style="padding:0; width:100px;font-size: <?php echo $layout["fsize"]?>;">
                        <?php foreach($provinces as $value){?> 
                            <option value="<?php echo $value["id"]?>" <?php echo $value["id"]==$province_id ? 'selected':''?>><?php echo $value["name"]?></option>
                            <?php }?>
                    </select>
                </td>
                <td width="35" style="text-align:right">
                    <a title="" href="#">
                        <img width="30" height="30" alt="print ketquaveso" src="<?php echo Yii::app()->params["static_url"]?>/images/print-code.png">
                    </a>  
                </td>
            </tr>
        </tbody>
    </table>

    <div class="btitle" style="background:<?php echo $layout["bg_color"]?>;padding:5px;margin-top:10px;font-size: <?php echo $layout["fsize"]?>;">
        <a rel="nofollow" href="<?php echo $link_province;?>" style="color:<?php echo $layout["tit_color"]?>;">
            <strong>KQXS <?php echo $provinces[$province_id]["name"]?> <?php echo $ngay_quay?></strong>
        </a> 
    </div>
    <div>
        <?php if($province["region"]==1){?>
            <table width="100%" cellspacing="0" cellpadding="0" border="1" style="background:#fff">
                <tr>
                    <td width="60px" style="font-size: <?php echo $layout["fsize"]?>;">Đặc biệt</td>
                    <td style="text-align:center"><strong class="giaidb" style="color: <?php echo $layout["db_color"]?>;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_dacbiet"]?></strong></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải nhất</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_nhat"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải nhì</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_nhi_1"]?> - <?php echo $data["giai_nhi_2"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải ba</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_ba_1"]?> - <?php echo $data["giai_ba_2"]?> - <?php echo $data["giai_ba_3"]?> - <?php echo $data["giai_ba_4"]?> - <?php echo $data["giai_ba_5"]?> - <?php echo $data["giai_ba_6"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải tư</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_tu_1"]?> - <?php echo $data["giai_tu_2"]?> - <?php echo $data["giai_tu_3"]?> - <?php echo $data["giai_tu_4"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải năm</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_nam_1"]?> - <?php echo $data["giai_nam_2"]?> - <?php echo $data["giai_nam_3"]?> - <?php echo $data["giai_nam_4"]?> - <?php echo $data["giai_nam_5"]?> - <?php echo $data["giai_nam_6"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải sáu</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_sau_1"]?> - <?php echo $data["giai_sau_2"]?> - <?php echo $data["giai_sau_3"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải bảy</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_bay_1"]?> - <?php echo $data["giai_bay_2"]?> - <?php echo $data["giai_bay_3"]?></td>
                </tr>
            </table>
            <?php }else{?>
            <table width="100%" cellspacing="0" cellpadding="0" border="1" style="background:#fff">
                <tr>
                    <td width="60px" style="font-size: <?php echo $layout["fsize"]?>;">Đặc biệt</td>
                    <td style="text-align:center"><strong class="giaidb" style="color: <?php echo $layout["db_color"]?>;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_dacbiet"]?></strong></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải nhất</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_nhat"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải nhì</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_nhi"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải ba</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_ba_1"]?> - <?php echo $data["giai_ba_2"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải tư</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_tu_1"]?> - <?php echo $data["giai_tu_2"]?> - <?php echo $data["giai_tu_3"]?> - <?php echo $data["giai_tu_4"]?> - <?php echo $data["giai_tu_5"]?> - <?php echo $data["giai_tu_6"]?> - <?php echo $data["giai_tu_7"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải năm</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_nam"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải sáu</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_sau_1"]?> - <?php echo $data["giai_sau_2"]?> - <?php echo $data["giai_sau_3"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải bảy</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_bay"]?></td>
                </tr>
                <tr>
                    <td style="font-size: <?php echo $layout["fsize"]?>;">Giải tám</td>
                    <td style="text-align:center;font-size: <?php echo $layout["fsize"]?>;"><?php echo $data["giai_tam"]?></td>
                </tr>
            </table>
            <?php }?>
    </div>
    </div>
