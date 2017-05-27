<script type="text/javascript">
    function ajaxTicket(){
        var strUrl = "<?php echo Url::createUrl("help/ajaxTicket") ?>"; 
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                fullname:$("#fullname").val(),
                mobile:$("#mobile").val(),
                address:$("#address").val(),
                province_id:$("#province_id").val(),
                type:$("input[name=type]:checked").val(),
                amount:$("#amount").val(),
                code:$("#code").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Bạn đã gửi yêu cầu nhận sổ kết quả thành công');
                    location.reload();
                }else{
                    $("#show_error").html(msg);
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
<div class="col-l">

    <div class="box box-ticker">    

        <h1 class="title-bor mag0"><strong>ĐĂNG KÝ NHẬN TICKER - SỔ KẾT QUẢ</strong></h1>
        <ul class="w22-75 pad10 ">
            <li class="magb10">
                <label class="in-block"><strong>Họ tên</strong></label>
                <div class="in-block">
                    <input type="text" id="fullname">
                </div>
            </li>
            <li class="magb10">
                <label class="in-block"><strong>Sđt</strong></label>
                <div class="in-block">
                    <input type="text" id="mobile">
                </div>
            </li>
            <li class="magb10">
                <label class="in-block"><strong>Địa chỉ</strong></label>
                <div class="in-block">
                    <input type="text" id="address">
                    <br/>
                    <em style="color: red;">Bạn nên nhập chi tiết địa chỉ để chúng tôi có thể chuyển đến tận nơi cho bạn</em>
                </div>
            </li>
            <li class="magb10">
                <label class="in-block"><strong>Tỉnh</strong></label>
                <div class="in-block">
                    <select id="province_id">
                        <?php foreach($provinces as $value){?>
                            <option value="<?php echo $value["id"]?>"><?php echo $value["name"]?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="magb10">
                <label class="in-block"><strong>Sản phẩm</strong></label>
                <div class="in-block">
                    <span class="mag-r5"><input checked type="radio" name="type" value="1" class="mag-r5">Ticket</span>
                    <span><input type="radio" name="type" value="2" class="mag-r5">Sổ kết quả</span>
                </div>
            </li>
            <li class="magb10">
                <label class="in-block w68"><strong>Số lượng</strong></label>
                <div class="in-block">
                    <input type="text" id="amount">
                </div>
            </li>
            <li class="magb10">
                <label class="fl"><strong>Mã xác thực</strong> <span class="clred">(*)</span>:</label>
                <div class="in-block">
                    <input type="text" class="mag-r5 magb10 fl" id="code" style="width: 100px;">
                    <img name="captcha" width="70" height="28" class="mag-r5 fl" alt="ma xac thuc" src="<?php echo Yii::app()->params["base_url"]?>/captcha/captcha.php">
                    <a class="ic refesh fl" title="" href="javascript:void(0)" onclick="reloadCaptcha('captcha','<?php echo Yii::app()->params["base_url"]?>/captcha');"></a>
                </div>
            </li>
            <li>
                <label class="in-block"></label>
                <div class="in-block">
                    <button class="bt-green" id="button_save" onclick="ajaxTicket()"><strong>Đăng ký</strong></button>
                </div>
            </li>
            <li>
                <div id="show_error" style="color: red;"></div>
            </li>
        </ul>
        <div class="bg_yellow pad10">
            <p>- Để nhận sổ kết quả và ticket kết quả, Quý vị vui lòng điền các thông tin liên hệ trong form trên. Chúng tôi sẽ gửi sổ kết quả và Ticket đến tận nơi cho bạn theo định kỳ.</p>
        </div>
    </div>
</div>