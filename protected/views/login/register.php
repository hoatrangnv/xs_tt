<?php
    $url = new Url();
?>
<script>
    $( document ).ready(function() {
        $.ajax({
            url: "http://amobi.tv/msisdn",
            success: function(data) {

            }
        });
    });
    function register(){
        var mobile = "84976796064";
        var clientTransId = "1234";
        var packageCode = "xs7";
        var price = "15000";
//        var callBackUrl = "http://xosothantai.vn/login/callback?mobile="+mobile;
        var callBackUrl = "http://localhost/xosothantai/login/callback?mobile="+mobile;
        var strUrl = "<?php echo $url->createUrl("login/ajaxRegister"); ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                mobile:mobile
                ,clientTransId:clientTransId
                ,packageCode:packageCode
                ,price:price
                ,callBackUrl:callBackUrl
            },
            success: function(msg){
                alert(msg);
                var res = msg.split("-");
                alert("- Tài khoản đã được đăng kí và kích hoạt \n- Số điện thoại : "+res[1]+" \n- Mật khẩu : " + res[2]);
                window.location = '<?php echo $url->createUrl("home/index")?>';
            }
        });
    }

</script>
<div class="page-login">
    <div class="container">

        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 cateHeader"">

            <div class="lgUp">
                <ul>
                    <li style="list-style: none;width: 45%;display: block;float: left;margin: 2.5%;border-radius: 5px;">
                        <h4><a href="javascript:;" style="color: #f0f0f0;">Gói Xổ Số Thần Tài Ngày</a></h4>
                        <div style="background: #ffffff" class="lgUpCt">
                            <label>Miễn phí ngày đăng ký đầu tiên</label>
                            Soạn:
                            <b>DK XS1</b> gửi <b>9898</b>
                            <i>(2000 đồng/ngày)</i>
                            <button class="resultBtn button button--moema button--border-thick button--size-s" type="button" onclick="register();">Đăng ký</button>
                        </div>
                    </li>
                    <li style="list-style: none;width: 45%;display: block;float: left;margin: 2.5%;border-radius: 5px;">
                        <h4><a href="javascript:;" style="color: #f0f0f0;">Gói Xổ Số Thần Tài Tuần</a></h4>
                        <div style="background: #ffffff" class="lgUpCt">
                            <label>Miễn phí ngày đăng ký đầu tiên</label>
                            Soạn:
                            <b>DK XS7</b> gửi <b>9898</b>
                            <i>(10.000 đồng/tuần)</i>
                            <button class="resultBtn button button--moema button--border-thick button--size-s" type="button" onclick="register();">Đăng ký</button>
                        </div>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>