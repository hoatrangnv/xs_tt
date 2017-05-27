<div class="col-l">


        <div class="cau-loto-day" id="load_buoccau">
            <?php
                if($region == 1){
                foreach($data as $key => $value){
                    $arr_loto = Common::getLotoMB($value);
                    $loto ="";
                    foreach($arr_loto as $k => $result){
                        if($result == $arrCau[$key-1]){
                            $result = "<font color='red'>".$result."</font>";
                        }
                        $loto.= ", ".$result;
                    }
                    $loto = ltrim($loto,",");
            ?>
            <div class="box-loop">
                <div id="kq" class="one-city">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="kqmb">
                        <tbody>
                        <tr>
                            <td colspan="12" style="text-align: center" class="txt-giai"><span style="font-weight: bold">Kết Quả Miền Bắc</span><span style="color:#ff0000"> ngày <?php echo  date('d-m-Y',strtotime($value['create_date']))?></span></td>
                        </tr>
                        <tr class="db">
                            <td class="txt-giai">Đặc biệt</td>
                            <td colspan="12" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_dacbiet",$value['giai_dacbiet'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="bggiai bg_f6">
                            <td class="txt-giai">Giải nhất</td>
                            <td colspan="12" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_nhat",$value['giai_nhat'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr>
                            <td class="txt-giai">Giải nhì </td>
                            <td colspan="6" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_nhi_1",$value['giai_nhi_1'],$x,$y,$region)?></strong></td>
                            <td colspan="6" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_nhi_2",$value['giai_nhi_2'],$x,$y,$region)?></strong></td>

                        </tr>
                        <tr class="giai3 bggiai bg_ef">
                            <td class="txt-giai" rowspan="2">Giải ba</td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_ba_1",$value['giai_ba_1'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_ba_2",$value['giai_ba_2'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_ba_3",$value['giai_ba_3'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="bggiai bg_ef">

                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_ba_4",$value['giai_ba_4'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_ba_5",$value['giai_ba_5'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_ba_6",$value['giai_ba_6'],$x,$y,$region)?></strong></td>

                        </tr>
                        <tr>
                            <td class="txt-giai">Giải tư</td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_tu_1",$value['giai_tu_1'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_tu_2",$value['giai_tu_2'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_tu_3",$value['giai_tu_3'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_tu_4",$value['giai_tu_4'],$x,$y,$region)?></strong></td>

                        </tr>

                        <tr class="giai5 bggiai bg_ef">
                            <td class="txt-giai" rowspan="2">Giải năm</td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_nam_1",$value['giai_nam_1'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_nam_2",$value['giai_nam_1'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_nam_3",$value['giai_nam_3'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="bggiai bg_ef">

                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_nam_4",$value['giai_nam_4'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_nam_5",$value['giai_nam_5'],$x,$y,$region)?></strong></td>
                            <td class="number" colspan="4"><strong class=""><?php echo  StringUtils::printboso("giai_nam_6",$value['giai_nam_6'],$x,$y,$region)?></strong></td>

                        </tr>
                        <tr>
                            <td class="txt-giai">Giải sáu</td>
                            <td colspan="4" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_sau_1",$value['giai_sau_1'],$x,$y,$region)?></strong></td>
                            <td colspan="4" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_sau_2",$value['giai_sau_2'],$x,$y,$region)?></strong></td>
                            <td colspan="4" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_sau_3",$value['giai_sau_3'],$x,$y,$region)?></strong></td>

                        </tr>
                        <tr class="bggiai bg_ef">
                            <td class="txt-giai">Giải bảy</td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_bay_1",$value['giai_bay_1'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_bay_2",$value['giai_bay_2'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_bay_3",$value['giai_bay_3'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo  StringUtils::printboso("giai_bay_4",$value['giai_bay_4'],$x,$y,$region)?></strong></td>

                        </tr>
                        <tr>
                            <td colspan="12" style="text-align: left" class="txt-giai"><span style="font-weight: bold">Kết quả :</span><?php echo  $loto?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <?php
                }}else{
                    $title = "Kết quả ".$province_name;
                    $html = "";
                    foreach ($data as $key => $value) {
                        $arr_loto = Common::getLotoMN($value);
                        $loto ="";
                        foreach($arr_loto as $k => $result){
                            if($result == $arrCau[$key-1]){
                                $result = "<font color='red'>".$result."</font>";
                            }
                            $loto.= ", ".$result;
                        }
                        $loto = ltrim($loto,",");
            ?>
            <div class="box-loop">
                <div id="kq" class="one-city">

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="kqmb">
                        <tbody>
                        <tr>
                            <td colspan="12" style="text-align: center" class="txt-giai"><span style="font-weight: bold"><?php echo $title?></span><span style="color:#ff0000"> ngày <?php echo date('d-m-Y',strtotime($value['create_date']))?></span></td>
                        </tr>
                        <tr class="giai8">
                            <td class="txt-giai">Giải tám</td>
                            <td colspan="12" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tam",$value['giai_tam'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="bg_ef">
                            <td class="txt-giai">Giải bảy</td>
                            <td colspan="12" class="number"><strong class=""><?php echo StringUtils::printboso("giai_bay",$value['giai_bay'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr>
                            <td class="txt-giai">Giải sáu</td>
                            <td colspan="4" class="number"><strong class=""><?php echo StringUtils::printboso("giai_sau_1",$value['giai_sau_1'],$x,$y,$region)?></strong></td>
                            <td colspan="4" class="number"><strong class=""><?php echo StringUtils::printboso("giai_sau_2",$value['giai_sau_2'],$x,$y,$region)?></strong></td>
                            <td colspan="4" class="number"><strong class=""><?php echo StringUtils::printboso("giai_sau_3",$value['giai_sau_3'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="bg_ef">
                            <td class="txt-giai">Giải năm</td>
                            <td colspan="12" class="number"><strong class=""><?php echo StringUtils::printboso("giai_nam",$value['giai_nam'],$x,$y,$region)?></strong></td>
                        </tr>

                        <tr class="giai4">
                            <td rowspan="2" class="txt-giai">Giải bốn</td>
                            <td colspan="3" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_1",$value['giai_tu_1'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_2",$value['giai_tu_2'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_3",$value['giai_tu_3'],$x,$y,$region)?></strong></td>
                            <td colspan="3" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_4",$value['giai_tu_4'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr>

                            <td colspan="4" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_5",$value['giai_tu_5'],$x,$y,$region)?></strong></td>
                            <td colspan="4" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_6",$value['giai_tu_6'],$x,$y,$region)?></strong></td>
                            <td colspan="4" class="number"><strong class=""><?php echo StringUtils::printboso("giai_tu_7",$value['giai_tu_7'],$x,$y,$region)?></strong></td>
                        </tr>

                        <tr class="bg_ef">
                            <td class="txt-giai">Giải ba</td>
                            <td colspan="6" class="number"><strong class=""><?php echo StringUtils::printboso("giai_ba_1",$value['giai_ba_1'],$x,$y,$region)?></strong></td>
                            <td colspan="6" class="number"><strong class=""><?php echo StringUtils::printboso("giai_ba_2",$value['giai_ba_2'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr>
                            <td class="txt-giai">Giải nhì</td>
                            <td colspan="12" class="number"><strong class=""><?php echo StringUtils::printboso("giai_nhi",$value['giai_nhi'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="bg_ef">
                            <td class="txt-giai">Giải nhất</td>
                            <td colspan="12" class="number"><strong class=""><?php echo StringUtils::printboso("giai_nhat",$value['giai_nhat'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr class="db">
                            <td class="txt-giai">Đặc biệt</td>
                            <td colspan="12" class="number"><strong class=""><?php echo StringUtils::printboso("giai_dacbiet",$value['giai_dacbiet'],$x,$y,$region)?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="12" style="text-align: left" class="txt-giai"><span style="font-weight: bold">Kết quả :</span><?php echo $loto?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }} ?>
        </div>

    <style>
        /*.adsense_bottom { width: 320px; height: 250px;}*/
        /*     @media(min-width:900px){ .adsense_bottom { width: 535px; height: 250px; text-align: center } }
            @media(max-width:899px){ .adsense_bottom { width: 320px; height: 250px; text-align: center } }*/
    </style>
</div>