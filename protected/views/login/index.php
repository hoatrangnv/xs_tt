<div class="page-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-11 col-lg-offset-11 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                <section class="logo-login">

                </section>
                <section class="login-form">
                    <form action="" method="post">
                        <ul class="bgform">
                            <li style="margin-bottom: 10px" class="linktop">
                                Chưa có tài khoản? <a href="">Đăng kí ngay!</a><br>
                            </li>
                            <li style="text-align: center">
                                <span style="font-weight: bold">Hãy đăng nhập để tiếp tục sử dụng dịch vụ</span>
                            </li><li style="text-align: center">
                                Lấy lại mật khẩu soạn tin <span style="font-weight: bold">MK</span> gửi <span style="font-weight: bold">9898</span>
                            </li>
                            <li>
                                <input type="text" class="imglogin text-login ic-email" placeholder="Nhập số điện thoại" value="<?php echo $user_remember; ?>" name="mobile" autocomplete="off">
                            </li>

                            <li>
                                <input type="password" class="imglogin text-login ic-password " placeholder="Mật khẩu" value="<?php echo $pass_remember; ?>" name="password" autocomplete="off" id="password">
                            </li>
                            <p class="note-login"> <?php echo $error; ?> </p>
                            <li class="clearfix">
                                <div class="fl">
                                    <input type="checkbox" <?php if(!empty($user_remember) && !empty($pass_remember)) echo "checked";?> class="check" value="1" name="remember">Luôn đăng nhập tự động
<!--                                    <p><a class="forgot" href="">Quên mật khẩu?</a></p>-->
                                </div>
                                <div class="fr">
                                    <button style="cursor: pointer;" name="login" type="submit" class="btnsignin reset"><b>Đăng nhập</b></button>
                                </div>
                            </li>
                        </ul>
                    </form>
                </section>

            </div>
        </div>
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
                            <button class="resultBtn button button--moema button--border-thick button--size-s" type="button" onclick="dang_ky();">Đăng ký</button>
                        </div>
                    </li>
                    <li style="list-style: none;width: 45%;display: block;float: left;margin: 2.5%;border-radius: 5px;">
                        <h4><a href="javascript:;" style="color: #f0f0f0;">Gói Xổ Số Thần Tài Tuần</a></h4>
                        <div style="background: #ffffff" class="lgUpCt">
                            <label>Miễn phí ngày đăng ký đầu tiên</label>
                            Soạn:
                            <b>DK XS7</b> gửi <b>9898</b>
                            <i>(10.000 đồng/tuần)</i>
                            <button class="resultBtn button button--moema button--border-thick button--size-s" type="button" onclick="dang_ky();">Đăng ký</button>
                        </div>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>