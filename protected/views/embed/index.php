<?php
    $layout = LoadConfig::$embed_default;
    $url = Yii::app()->params["http_url"].Url::createUrl("embed/code");
?>               
<script src="<?php  echo Yii::app()->params['static_url']; ?>/js/jscolor/jscolor.js" type="text/javascript"></script>
<script type="text/javascript">
    function getNewCode(){
        var strUrl = "<?php echo Yii::app()->params["http_url"].Url::createUrl("embed/ajaxChange") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                province_id:$("#province_id").val(),
                bg_color:$("#bg_color").val(),
                tit_color:$("#tit_color").val(),
                db_color:$("#db_color").val(),
                width:$("#width").val(),
                fsize:$("#fsize").val(),
            },
            success: function(msg){
                if(msg !=""){
                    $("#source_code").val(msg);
                    $("#source_display").html(msg);
                }
            }          
        });
    } 
</script>
<div class="col-l">
    <div class="box box-embeb">
        <h1 class="title-bor"><strong>Chèn KQXS vào Website, Blog của bạn</strong></h1>
        <p class="pad5">Chọn tỉnh mặc định, hiệu chỉnh và lấy bảng KQXS phù hợp với khoản trống trên website của bạn. Ngoài ra bạn cũng có thể tùy biến lại code đễ có được kết quả vừa ý nhất! </p>
        <ul class="pad5 opt-embeb">
            <li class="clearfix pad5">
                <label class="fl"><strong>KQXS Tỉnh:</strong></label>
                <div class="in-block">
                    <select id="province_id" onchange="getNewCode()">
                        <?php foreach($provinces as $value){?>
                            <option value="<?php echo $value["id"]?>"><?php echo $value["name"]?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix pad5">
                <label class="fl"><strong>Màu nền:</strong></label>
                <div class="in-block">
                    # <input onchange="getNewCode()" id="bg_color" class="jscolor" type="text" value="<?php echo $layout["bg_color"]?>">
                </div>
            </li>
            <li class="clearfix pad5">
                <label class="fl"><strong>Màu tiêu đề:</strong></label>
                <div class="in-block">
                    # <input onchange="getNewCode()" id="tit_color" class="jscolor" type="text" value="<?php echo $layout["tit_color"]?>">
                </div>
            </li>
            <li class="clearfix pad5">
                <label class="fl"><strong>Màu giải ĐB:</strong></label>
                <div class="in-block">
                    # <input onchange="getNewCode()" id="db_color" class="jscolor" type="text" value="<?php echo $layout["db_color"]?>">
                </div>
            </li>
            <li class="clearfix pad5">
                <label class="fl"><strong>Chiều rộng:</strong></label>
                <div class="in-block">
                    <input onchange="getNewCode()" id="width" type="text" value="<?php echo $layout["width"]?>"> <em class="cl9">(90%,200px...)</em>
                </div>
            </li>
            <li class="clearfix pad5">
                <label class="fl"><strong>Font size:</strong></label>
                <div class="in-block">
                    <input onchange="getNewCode()" id="fsize" type="text" value="<?php echo $layout["fsize"]?>"> <em class="cl9">(12px...)</em>
                </div>
            </li>
        </ul>    
        <div class="pad10-5 bg_f9">
            <strong class="clred">Mã nhúng:</strong> Copy đoạn mã bên dưới chèn vào nơi bạn muốn bảng kết quả xổ số hiển thị trên website của bạn
        </div>
        <div class="pad10-5"><textarea style="width:97%;height:60px" id="source_code"><?php echo Embed::genHtmlEmbed($url);?></textarea></div>
        <div class="pad10-5 bg_f9 magb25"><strong class="clred">Xem trước:</strong></div>    


        <div align="center" class="scoll" id="source_display"><?php echo Embed::genHtmlEmbed($url);?></div>
        <div class="pad10-5 bg_f9"><strong class="clred">Lấy kết quả xổ số từ hệ thống về websites của bạn!</strong></div>
        <div class="pad5">
            <p class="cl-green"><strong>Lấy 1 bảng kết quả tùy biến</strong></p>
            <p class="mag0">+ Công cụ hoàn toàn miễn phí (100% free)</p>
            <p class="mag5-0">+ Hệ thống ổn định nhất, băng thông lớn load nhẹ nhàng</p>
            <p class="mag0">+ Cam kết không chèn quảng cáo, chỉ 1 icon edit trỏ về trang cập nhật mã khi có phiên bản mới. (chỉ hiển thị trong giai đoạn update)</p>
            <p class="mag5-0">+ Tính năng tối ưu:</p>
            <p class="mag0">- Có thể lấy trang mặc định tùy ý làm trang chủ phù hợp với website từng khu vực</p>
            <p class="mag5-0">- Có thể tùy chỉnh màu sắc, font chữ phù hợp</p>
            <p class="mag0">- Xem được tất cả kết quả xổ số truyền thống toàn quốc trên 1 bảng</p>
            <p class="mag5-0">- Bạn hoàn toàn có thể tùy biến thành 1 websites kết quả xổ số chuyên nghiệp với nhiều trang, trên mỗi trang lấy 1 bảng kqxs mặc định khác nhau theo tỉnh.</p>
            <p class="mag0">+ Dữ liệu cập nhật nhanh nhất, dung lượng tối ưu phù hợp lấy cho ứng dụng mobile </p>

        </div>
    </div>

    <div class="clearfix">
        <div class="conect_out pad5">
            <?php
                $this->renderPartial("application.views.layouts.social");
            ?>
        </div>
    </div>
</div>