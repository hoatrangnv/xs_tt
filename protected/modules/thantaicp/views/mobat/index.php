<?php
$url = new Url();
?>
<script>
    function ajaxSaveMobat(province){
        var str_csloto = $("#csloto_0_"+province).val() + "," + $("#csloto_1_"+province).val();
        var str_cdb = $("#dbcham_0_"+province).val() + "," + $("#dbcham_1_"+province).val();
        var str_csdacbiet = $("#csdacbiet_0_"+province).val() + "," + $("#csdacbiet_1_"+province).val();

        var strUrl = "<?=$url->createUrl("mobat/ajaxSaveMobat") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                province:province,
                csloto:str_csloto,
                chamdb:str_cdb,
                csdacbiet:str_csdacbiet,
                open_date:$("#open_date").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Lưu thành công');
//                    window.location = '<?php //echo $url->createUrl("admin/index")?>//';
                }else{
                    alert(msg);
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_save").removeAttr("disabled");
            }
        });
    }
</script>

<div class="Main_col_1 main clearfix" style="width: 100%">


    <div class="title_inline">
        <h1>MỞ BÁT </h1>

        <h2 style="display: inline;"> <!--| <a href="lich-su-du-doan-ket-qua-xo-so.html">LỊCH SỬ MỞ BÁT</a>--></h2>
    </div>
    <div class="h2_line">
        <div class="h2_line_2"></div>
    </div>

    <div class="boxTKNHAP mbat">
        <div class="MOBAT_box_menu">
            <ul class="mb_tabs">
                <li data-tab="mobat_MB" class="MOBAT_box_menu_activer"><a>MỞ BÁT MB</a></li>
                <li data-tab="mobat_MN"><a>MỞ BÁT MN</a></li>
                <li data-tab="mobat_MT"><a>MỞ BÁT MT</a></li>
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

        <input type="hidden" id="open_date" value="<?php echo $open_date; ?>">
        <div class="MOBAT_box mobat_MB mobat_current">
            MỞ BÁT XỔ SỐ <span class="red upper">Miền Bắc</span> ngày <?php echo $open_date; ?><br>CẶP SỐ LOTO HÔM NAY:
            <?php
            $arrcsloto = explode(",",$result[1]['capso_loto']);
            $arrdacbietcham = explode(",",$result[1]['db_cham']);
            $arrcsdacbiet = explode(",",$result[1]['capso_dacbiet']);
            ?>
            <input id="csloto_0_1" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsloto[1]) ? $arrcsloto[0] : ""; ?>" style="width: 25px;height: 20px">
            <input id="csloto_1_1" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsloto[1]) ? $arrcsloto[1] : ""; ?>" style="width: 25px;height: 20px">
            <br>
            ĐẶC BIỆT CHẠM:
            <input id="dbcham_0_1" class="MOBAT_box_number_SAI" value="<?php echo isset($arrdacbietcham[1]) ? $arrdacbietcham[0] : ""; ?>" style="width: 25px;height: 20px">
            <input id="dbcham_1_1" class="MOBAT_box_number_SAI" value="<?php echo isset($arrdacbietcham[1]) ? $arrdacbietcham[1] : ""; ?>" style="width: 25px;height: 20px">
            <br>

            MỞ BÁT CẶP SỐ ĐẶC BIỆT:
            <input id="csdacbiet_0_1" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsdacbiet[1]) ? $arrcsdacbiet[0] : ""; ?>" style="width: 25px;height: 20px">
            <input id="csdacbiet_1_1" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsdacbiet[1]) ? $arrcsdacbiet[1] : ""; ?>" style="width: 25px;height: 20px">
            <div class="filltext">
                <input id="button_save" onclick="ajaxSaveMobat(1)" type="button" class="btn-gray" value="   Save  ">
            </div>
        </div>

        <?php foreach ($data[3] as $key => $value){ ?>
            <div class="MOBAT_box mobat_MN ">
                MỞ BÁT XỔ SỐ <span class="red upper"><?php echo $value['name']; ?></span> ngày <?php echo $open_date; ?><br>CẶP SỐ LOTO HÔM NAY:
                <?php
                $arrcsloto = explode(",",$result[$value['id']]['capso_loto']);
                $arrdacbietcham = explode(",",$result[$value['id']]['db_cham']);
                $arrcsdacbiet = explode(",",$result[$value['id']]['capso_dacbiet']);
                ?>
                <input id="csloto_0_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsloto[1]) ? $arrcsloto[0] : ""; ?>" style="width: 25px;height: 20px">
                <input id="csloto_1_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsloto[1]) ? $arrcsloto[1] : ""; ?>" style="width: 25px;height: 20px">
                <br>
                ĐẶC BIỆT CHẠM:
                <input id="dbcham_0_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrdacbietcham[1]) ? $arrdacbietcham[0] : ""; ?>" style="width: 25px;height: 20px">
                <input id="dbcham_1_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrdacbietcham[1]) ? $arrdacbietcham[1] : ""; ?>" style="width: 25px;height: 20px">
                <br>

                MỞ BÁT CẶP SỐ ĐẶC BIỆT:
                <input id="csdacbiet_0_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsdacbiet[1]) ? $arrcsdacbiet[0] : ""; ?>" style="width: 25px;height: 20px">
                <input id="csdacbiet_1_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsdacbiet[1]) ? $arrcsdacbiet[1] : ""; ?>" style="width: 25px;height: 20px">
                <div class="filltext">
                    <input id="button_save" onclick="ajaxSaveMobat(<?php echo $value['id'] ?>)" type="button" class="btn-gray" value="   Save  ">
                </div>
            </div>
        <?php } ?>

        <?php foreach ($data[2] as $key => $value){ ?>
            <div class="MOBAT_box mobat_MT ">
                MỞ BÁT XỔ SỐ <span class="red upper"><?php echo $value['name']; ?></span> ngày <?php echo $open_date; ?><br>CẶP SỐ LOTO HÔM NAY:
                <?php
                $arrcsloto = explode(",",$result[$value['id']]['capso_loto']);
                $arrdacbietcham = explode(",",$result[$value['id']]['db_cham']);
                $arrcsdacbiet = explode(",",$result[$value['id']]['capso_dacbiet']);
                ?>
                <input id="csloto_0_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsloto[1]) ? $arrcsloto[0] : ""; ?>" style="width: 25px;height: 20px">
                <input id="csloto_1_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsloto[1]) ? $arrcsloto[1] : ""; ?>" style="width: 25px;height: 20px">
                <br>
                ĐẶC BIỆT CHẠM:
                <input id="dbcham_0_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrdacbietcham[1]) ? $arrdacbietcham[0] : ""; ?>" style="width: 25px;height: 20px">
                <input id="dbcham_1_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrdacbietcham[1]) ? $arrdacbietcham[1] : ""; ?>" style="width: 25px;height: 20px">
                <br>

                MỞ BÁT CẶP SỐ ĐẶC BIỆT:
                <input id="csdacbiet_0_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsdacbiet[1]) ? $arrcsdacbiet[0] : ""; ?>" style="width: 25px;height: 20px">
                <input id="csdacbiet_1_<?php echo $value['id'] ?>" class="MOBAT_box_number_SAI" value="<?php echo isset($arrcsdacbiet[1]) ? $arrcsdacbiet[1] : ""; ?>" style="width: 25px;height: 20px">
                <div class="filltext">
                    <input id="button_save" onclick="ajaxSaveMobat(<?php echo $value['id'] ?>)" type="button" class="btn-gray" value="   Save  ">
                </div>
            </div>
        <?php } ?>

        <div class="PTLT_KQ_Numbers" id="cauketqua">
            <!-- in cau ket qua-->
        </div>
    </div>


</div>