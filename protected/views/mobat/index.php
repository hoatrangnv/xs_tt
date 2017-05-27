<?php $url = new Url(); ?>
<div class="Main_col_1 col-l" style="width: 535px">
    <div class="title_inline">
        <h1>SỐ THẦN TÀI </h1>

        <h2 style="display: inline;"> | <a href="<?php echo $url->createUrl("mobat/history"); ?>">LỊCH SỬ SỐ THẦN TÀI</a></h2>
    </div>
    <div class="h2_line">
        <div class="h2_line_2"></div>
    </div>

    <div class="boxTKNHAP mbat col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
        <div class="MOBAT_box_menu">
            <ul class="mb_tabs">
                <li data-tab="mobat_MB" class="MOBAT_box_menu_activer"><a>THẦN TÀI MB</a></li>
                <li data-tab="mobat_MN"><a>THẦN TÀI MN</a></li>
                <li data-tab="mobat_MT"><a>THẦN TÀI MT</a></li>
            </ul>
            <div class="both"></div>
        </div>
        <div style="font-style: italic; font-size: 11px;">
            (*) Lưu ý: Các con số chỉ mang tính chất tham khảo
        </div>
        <script>
            $(document).ready(function () {

                $('ul.mb_tabs li').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('ul.mb_tabs li').removeClass('MOBAT_box_menu_activer');
                    $('.MOBAT_box').removeClass('mobat_current');

                    $(this).addClass('MOBAT_box_menu_activer');
                    $("." + tab_id).addClass('mobat_current');
                    $("#cauketqua").addClass('mobat_hide');
                })

            })

        </script>


        <div class="MOBAT_box mobat_MB mobat_current">
            SỐ THẦN TÀI <span class="red upper">Miền Bắc</span> ngày <?php echo date('d-m-Y', time()); ?><br>CẦU LOTO ĐẸP NHẤT:
            <?php
                $arrcsloto = explode(",",$result[1]['capso_loto']);
                $arrdacbietcham = explode(",",$result[1]['db_cham']);
                $arrcsdacbiet = explode(",",$result[1]['capso_dacbiet']);
                $arr_cau_id_csloto = explode(",",$result[1]['cau_id_capso_loto']);
                $arr_cau_id_dacbietcham = explode(",",$result[1]['cau_id_db_cham']);
                $arr_cau_id_csdacbiet = explode(",",$result[1]['cau_id_capso_dacbiet']);

            ?>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[0],"cau_id"=>$arr_cau_id_csloto[0],"region"=>1,"province_name"=>'Miền Bắc')); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[0]) ? $arrcsloto[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[1],"cau_id"=>$arr_cau_id_csloto[1],"region"=>1,"province_name"=>'Miền Bắc')); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[1]) ? $arrcsloto[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CẦU ĐẶC BIỆT ĐẸP NHẤT:
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[0],"cau_id"=>$arr_cau_id_dacbietcham[0],"region"=>1,"province_name"=>'Miền Bắc')); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? $arrdacbietcham[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[1],"cau_id"=>$arr_cau_id_dacbietcham[1],"region"=>1,"province_name"=>'Miền Bắc')); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[1]) ? $arrdacbietcham[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CHẠM ĐẶC BIỆT:
            <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 0,-1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CẦU 2 NHÁY ĐẸP NHẤT:
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[0],"cau_id"=>$arr_cau_id_csdacbiet[0],"region"=>1,"province_name"=>'Miền Bắc')); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[0]) ? $arrcsdacbiet[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[1],"cau_id"=>$arr_cau_id_csdacbiet[1],"region"=>1,"province_name"=>'Miền Bắc')); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[1]) ? $arrcsdacbiet[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
        </div>

        <?php foreach ($data[3] as $key => $value){ ?>
        <div class="MOBAT_box mobat_MN ">
            SỐ THẦN TÀI <span class="red upper"><?php echo $value['name']; ?></span> ngày <?php echo date('d-m-Y', time()); ?><br>CẦU LOTO ĐẸP NHẤT:
            <?php
            $arrcsloto = explode(",",$result[$value['id']]['capso_loto']);
            $arrdacbietcham = explode(",",$result[$value['id']]['db_cham']);
            $arrcsdacbiet = explode(",",$result[$value['id']]['capso_dacbiet']);
            $arr_cau_id_csloto = explode(",",$result[$value['id']]['cau_id_capso_loto']);
            $arr_cau_id_dacbietcham = explode(",",$result[$value['id']]['cau_id_db_cham']);
            $arr_cau_id_csdacbiet = explode(",",$result[$value['id']]['cau_id_capso_dacbiet']);
            ?>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[0],"cau_id"=>$arr_cau_id_csloto[0],"region"=>3,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[0]) ? $arrcsloto[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[1],"cau_id"=>$arr_cau_id_csloto[1],"region"=>3,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[1]) ? $arrcsloto[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CẦU ĐẶC BIỆT ĐẸP NHẤT:
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[0],"cau_id"=>$arr_cau_id_dacbietcham[0],"region"=>3,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? $arrdacbietcham[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[1],"cau_id"=>$arr_cau_id_dacbietcham[1],"region"=>3,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[1]) ? $arrdacbietcham[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CHẠM ĐẶC BIỆT:
            <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 0, -1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CẦU 2 NHÁY ĐẸP NHẤT:
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[0],"cau_id"=>$arr_cau_id_csdacbiet[0],"region"=>3,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[0]) ? $arrcsdacbiet[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[1],"cau_id"=>$arr_cau_id_csdacbiet[1],"region"=>3,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[1]) ? $arrcsdacbiet[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
        </div>
        <?php } ?>

        <?php foreach ($data[2] as $key => $value){ ?>
        <div class="MOBAT_box mobat_MT ">
            SỐ THẦN TÀI <span class="red upper"><?php echo $value['name']; ?></span> ngày <?php echo date('d-m-Y', time()); ?><br>CẦU LOTO ĐẸP NHẤT:
            <?php
            $arrcsloto = explode(",",$result[$value['id']]['capso_loto']);
            $arrdacbietcham = explode(",",$result[$value['id']]['db_cham']);
            $arrcsdacbiet = explode(",",$result[$value['id']]['capso_dacbiet']);
            $arr_cau_id_csloto = explode(",",$result[$value['id']]['cau_id_capso_loto']);
            $arr_cau_id_dacbietcham = explode(",",$result[$value['id']]['cau_id_db_cham']);
            $arr_cau_id_csdacbiet = explode(",",$result[$value['id']]['cau_id_capso_dacbiet']);
            ?>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[0],"cau_id"=>$arr_cau_id_csloto[0],"region"=>2,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[0]) ? $arrcsloto[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsloto[1],"cau_id"=>$arr_cau_id_csloto[1],"region"=>2,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsloto[1]) ? $arrcsloto[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CẦU ĐẶC BIỆT ĐẸP NHẤT:
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[0],"cau_id"=>$arr_cau_id_dacbietcham[0],"region"=>2,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? $arrdacbietcham[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrdacbietcham[1],"cau_id"=>$arr_cau_id_dacbietcham[1],"region"=>2,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[1]) ? $arrdacbietcham[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CHẠM ĐẶC BIỆT:
            <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 0 ,-1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a href="javascript:void(0)" class="MOBAT_box_number_SAI"><?php echo !empty($arrdacbietcham[0]) ? substr($arrdacbietcham[0], 1) : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <br>
            CẦU 2 NHÁY ĐẸP NHẤT:
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[0],"cau_id"=>$arr_cau_id_csdacbiet[0],"region"=>2,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[0]) ? $arrcsdacbiet[0] : "&nbsp;&nbsp;&nbsp;"; ?></a>
            <a target="_blank" href="<?php echo Url::createUrl("soicau/detail",array("boso"=>$arrcsdacbiet[1],"cau_id"=>$arr_cau_id_csdacbiet[1],"region"=>2,"province_name"=>$value['name'])); ?>" class="MOBAT_box_number_SAI" ><?php echo !empty($arrcsdacbiet[1]) ? $arrcsdacbiet[1] : "&nbsp;&nbsp;&nbsp;"; ?></a>
        </div>
        <?php } ?>

        <div class="PTLT_KQ_Numbers" id="cauketqua">
            <!-- in cau ket qua-->
        </div>
    </div>


</div>