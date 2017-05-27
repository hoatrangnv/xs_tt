<?php
    $url = new Url(); $provName ="";   
    function getExactlePredict($number_predict,$ketqua){
        $a = substr($number_predict, 0 ,-1);
        $b = substr($number_predict, 1);
        $ab = $a.$b;
        $ba = $b.$a;
        foreach($ketqua as $key =>$value){
            if($ab == $value || $ba == $value){
                $number_predict = "<font color='red'>".$number_predict."</font>";
            }
        }
        return $number_predict;
    }
?>
<div class="Main_col_1 col-l" style="width: 535px">
    <div class="title_inline">
        <h2 style="display: inline;"> <a href="<?php echo $url->createUrl("mobat/index"); ?>">SỐ THẦN TÀI</a> | </h2>

        <h1>LỊCH SỬ SỐ THẦN TÀI</h1>
    </div>
    <div class="h2_line">
        <div class="h2_line_2"></div>
    </div>

    <div class="boxTKNHAP">
        <form method="get">
            <select name="province_id" class="From_Tinh">
                <?php foreach($listProvince as $key => $value){ ?>
                    <option <?php if( $province_id == $key){ echo 'selected ="true"';} ?> value="<?php echo $key; ?>"><?php echo $value ?></option>
                <?php } ?>
            </select>

            &nbsp;
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'bien_ngay',
                'id' => 'bien_ngay',
                'value' => $bien_ngay,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'changeYear' => 'true',
                    'changeMonth' => 'true',
                    'showOn' => 'both',
                    'buttonText' => '...'
                ),
                'htmlOptions' => array(
                    'style' => 'width:170px',
                    'class' => 'form',
                ),
            ));
            ?>
            <br>
            Số ngày xem:
            <input name="maxRow" type="text" value="5" size="3" maxlength="3" class="From_Nhập"><br>
            <button class="From_KQ" type="submit">
                XEM
            </button><br>(Bạn được xem tối đa lịch sử số thần tài trong 30 ngày)
        </form>
        <?php foreach ($result as $key => $value){ ?>

            <div class="MOBAT_box mobat_MN ">
                SỐ THẦN TÀI <span class="red upper"><?php echo $provinceName; ?></span> ngày <?php echo date('d-m-Y',strtotime($value['create_date'])); ?><br>CẦU LOTO ĐẸP NHẤT:
                <?php
                $arrcsloto = explode(",",$value['capso_loto']);
                $arrdacbietcham = explode(",",$value['db_cham']);
                $arrcsdacbiet = explode(",",$value['capso_dacbiet']);
                $arr_cau_id_csloto = explode(",",$value['cau_id_capso_loto']);
                $arr_cau_id_dacbietcham = explode(",",$value['cau_id_db_cham']);
                $arr_cau_id_csdacbiet = explode(",",$value['cau_id_capso_dacbiet']);
                if($region ==1){
                   $arr_loto = Common::getLotoMB($data[$key]);   
                }else{
                   $arr_loto = Common::getLotoMN($data[$key]);   
                }


                ?>
                <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[0],"cau_id"=>$arr_cau_id_csloto[0],"region"=>$region,"province_name"=>$provinceName)); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[0]) ? getExactlePredict($arrcsloto[0],$arr_loto) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[1],"cau_id"=>$arr_cau_id_csloto[1],"region"=>$region,"province_name"=>$provinceName)); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[1]) ? getExactlePredict($arrcsloto[1],$arr_loto) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <br>
                CẦU ĐẶC BIỆT ĐẸP NHẤT:
                <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[0],"cau_id"=>$arr_cau_id_dacbietcham[0],"region"=>$region,"province_name"=>$provinceName)); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? getExactlePredict($arrdacbietcham[0],$arr_loto) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[1],"cau_id"=>$arr_cau_id_dacbietcham[1],"region"=>$region,"province_name"=>$provinceName)); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[1]) ? getExactlePredict($arrdacbietcham[1],$arr_loto) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <br>
                CHẠM ĐẶC BIỆT:
                <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 0 ,-1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <br>
                CẦU 2 NHÁY ĐẸP NHẤT:
                <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[0],"cau_id"=>$arr_cau_id_csdacbiet[0],"region"=>$region,"province_name"=>$provinceName)); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[0]) ? getExactlePredict($arrcsdacbiet[0],$arr_loto) : "&nbsp;&nbsp;&nbsp;"; ?></a>
                <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[1],"cau_id"=>$arr_cau_id_csdacbiet[1],"region"=>$region,"province_name"=>$provinceName)); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[1]) ? getExactlePredict($arrcsdacbiet[1],$arr_loto) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            </div>

        <?php } ?>

    </div>

</div>
