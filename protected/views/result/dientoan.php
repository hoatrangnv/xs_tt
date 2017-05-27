<?php
    $time = isset($dt123["ngay_quay"]) ? strtotime($dt123["ngay_quay"]) : time();
    $date_quay = getdate($time);
    $url_action_form = Url::createUrl("result/dientoan");
    $date_result[1] = date('d-m-Y',$time+86400);
    $date_result[-1] = date('d-m-Y',$time-86400);
    $date_result[-2] = date('d-m-Y',$time-2*86400);
    $date_result[-3] = date('d-m-Y',$time-3*86400);
    $url_date[1] = Url::createUrl("result/dientoan",array("ngay"=>date('d',strtotime($date_result[1])),"thang"=>date('m',strtotime($date_result[1])),"nam"=>date('Y',strtotime($date_result[1]))));
    $url_date[-1] = Url::createUrl("result/dientoan",array("ngay"=>date('d',strtotime($date_result[-1])),"thang"=>date('m',strtotime($date_result[-1])),"nam"=>date('Y',strtotime($date_result[-1]))));
    $url_date[-2] = Url::createUrl("result/dientoan",array("ngay"=>date('d',strtotime($date_result[-2])),"thang"=>date('m',strtotime($date_result[-2])),"nam"=>date('Y',strtotime($date_result[-2]))));
    $url_date[-3] = Url::createUrl("result/dientoan",array("ngay"=>date('d',strtotime($date_result[-3])),"thang"=>date('m',strtotime($date_result[-3])),"nam"=>date('Y',strtotime($date_result[-3]))));

    $url_search = Yii::app()->params["http_url"].'/ket-qua-dien-toan';
?>
<div class="col-l">
    <div class="box info-city">
        <h1 class="title-bor mag0"><strong>
                <?php if(!empty($ngay_quay)){
                        $date = getdate(strtotime($ngay_quay));
                        $day = Common::getWeekDay($date["wday"]);
                    ?>
                    Xổ số điện toán <?php echo !empty($ngay_quay) ? 'ngày '.date('d/m/Y',strtotime($ngay_quay)) : ""?> - <?php echo $day["label"]?>
                    <?php }else{?>
                    Xổ số điện toán
                    <?php }?>

            </strong></h1>
    </div>
    <div class="box">

        <div class="pad5">
            <div class="box-note">
                <p style="text-align: justify;"><strong>Xổ số điện toán</strong> là loại hình xổ số mà trong đó, người chơi được phép chọn số tùy thích, có thêm nhiều lựa chọn mua vé qua internet hay thiết bị di động như với <strong>xổ số truyền thống</strong>, đặc biệt là giải thưởng của xổ số điện toán sẽ được cộng dồn cho đến khi có người nhận thưởng giúp gia tăng giá trị thưởng của người dùng. Xổ số điện toán có nhiều hình thức chơi như lô tô tự chọn; <strong>xổ số điện toán 123</strong>, xổ số 6x36, xổ số Thần tài 4 với nhiều lựa chọn phong phú:</p>
                <p style="text-align: justify;"><strong>Lô Tô tự chọn 5 số</strong> là loại hình chơi mới mang đến cho khách hàng rất nhiều cơ hội trúng thưởng. Với việc mua 5 số bất kỳ, khách hàng có thể so với tất cả các giải của kết quả Xổ số truyền thống.<strong> Giải đặc biệt có giá trị tiền thưởng gấp 10.000 lần giá trị</strong> vé mua nếu như 5 số mua của khách hàng trùng với 5 số của giải đặc biệt Xổ số truyền thống. Ngoài ra còn nhiều giải khác</p>

            </div>
        </div>
    </div>
    <div class="box-kq"> 
        <div class="title-bor magb10">
            <div class="opt_date opt_date_full">
                <select id="ngay">
                    <?php for($i=1;$i<=31;$i++){?>
                        <option value="<?php echo $i?>" <?php echo date("d",$time)==$i ? 'selected':''?>>Ngày <?php echo $i?></option>
                        <?php }?>
                </select>
                <select id="thang">
                    <?php for($i=1;$i<=12;$i++){?>
                        <option value="<?php echo $i?>" <?php echo date("m",$time)==$i ? 'selected':''?>>Tháng <?php echo $i?></option>
                        <?php }?>
                </select>
                <select id="nam">
                    <?php for($i=2010;$i<=date('Y');$i++){?>
                        <option value="<?php echo $i?>" <?php echo date("Y",$time)==$i ? 'selected':''?>>Năm <?php echo $i?></option>
                        <?php }?>
                </select>
                <button class="bt-red" type="button" onclick="searchKQ('<?php echo $url_search;?>',0)"><strong>Tìm</strong></button>
            </div>
        </div> 
        <div class="box">
            <ul class="dientoan clearfix">
                <?php if($dt123){?>
                    <li class="first">
                        <h2 class="pad10-5"><strong>Kết Quả Xổ Số Điện Toán 123 <?php echo !empty($dt123["ngay_quay"]) ? 'ngày '.date('d/m/Y',strtotime($dt123["ngay_quay"])) : ""?></strong></h2>
                        <div><span><?php echo $dt123["ketqua_1"]?></span><span><?php echo $dt123["ketqua_2"]?></span><span><?php echo $dt123["ketqua_3"]?></span></div>
                    </li>
                    <?php }?>
                <?php if($thantai){?>
                    <li class="second">
                        <h2 class="pad10-5"><strong>Kết Quả Xổ Số Thần Tài <?php echo !empty($thantai["ngay_quay"]) ? 'ngày '.date('d/m/Y',strtotime($thantai["ngay_quay"])) : ""?></strong></h2>
                        <div><span><?php echo $thantai["ketqua"]?></span></div>
                    </li>
                    <?php }?>
                <?php if($dt6x36){?>
                    <li class="last">
                        <h2 class="pad10-5"><strong>Kết Quả Xổ Số Điện Toán 6x36 <?php echo !empty($dt6x36["ngay_quay"]) ? 'ngày '.date('d/m/Y',strtotime($dt6x36["ngay_quay"])) : ""?></strong></h2>
                        <div>
                            <span><?php echo $dt6x36["ketqua_1"]?></span>
                            <span><?php echo $dt6x36["ketqua_2"]?></span>
                            <span><?php echo $dt6x36["ketqua_3"]?></span>
                            <span><?php echo $dt6x36["ketqua_4"]?></span>
                            <span><?php echo $dt6x36["ketqua_5"]?></span>
                            <span><?php echo $dt6x36["ketqua_6"]?></span>
                        </div>
                    </li>
                    <?php }?>
            </ul>
        </div>
        <div class="conect_out pad5">
            <?php $this->renderPartial("application.views.layouts.social");?>
        </div>
        <div class="box pad10-5">
            <ul class="list-dot-red">
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="Kết quả điện toán ngày <?php echo $date_result[-1]?>" href="<?php echo $url_date[-1]?>">Kết quả điện toán ngày <?php echo $date_result[-1]?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="Kết quả điện toán ngày <?php echo $date_result[-2]?>" href="<?php echo $url_date[-2]?>">Kết quả điện toán ngày <?php echo $date_result[-2]?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="Kết quả điện toán ngày <?php echo $date_result[-3]?>" href="<?php echo $url_date[-3]?>">Kết quả điện toán ngày <?php echo $date_result[-3]?></a>
                </li>
            </ul>
        </div>
        <div class="cp-sms">
            <p class="pad5">Để nhận kết quả xổ số <strong>Điện toán</strong> sớm nhất, soạn <strong class="clred">DIENTOAN</strong> gửi <strong class="clred">8512</strong></p>
        </div>
    </div>
</div>