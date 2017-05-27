<?php
    $html = $this->renderPartial("tpl_result",
        array(
            "dates"=>$dates,
            "data"=>$data,
            "ngay_quay"=>$ngay_quay,
            "provinces"=>$provinces,
            "province"=>$province,
            "province_id"=>$province_id,
            "layout"=>$layout
        ),true
    );
    $html = Common::sanitize_output($html); 
?>
function getNewBoxHtml(){
    $("#box_nhung_ketquaveso").html('<script language="javascript" src="<?php echo Yii::app()->params["base_url"]?>/nhung-ket-qua/tinh-'+$("#ma_tinh").val()+'"></script>')
    updatecolor();
}
function getNewBoxNgay(){ 
    $("#box_nhung_ketquaveso").html('<script language="javascript" src="<?php echo Yii::app()->params["base_url"]?>/nhung-ket-qua/tinh-'+$("#ma_tinh").val()+'/ngay-'+$("#ngay_quay").val()+'"></script>')
    updatecolor();
}
function updatecolor() { 
    $(".btitle").css('background-color',bg_color); 
    $(".btitle").css('color',tit_color); 
    $(".giaidb").css('color',db_color); 
    $(".bwidth").css('width',width); 
    $("#box_nhung_ketquaveso td, #box_nhung_ketquaveso div,#box_nhung_ketquaveso select").css('font-size',fsize); 
}
$("#box_nhung_ketquaveso").html('');
$("#box_nhung_ketquaveso").append('<?php echo $html;?>');
$(document).ready(function(){
    updatecolor();
});

