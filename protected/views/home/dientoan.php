
<div class="col-l">
    <?php $this->renderPartial("application.views.module.result_in_day_top"); ?>
    <div class="box-kq">
        <div class="box">
            <?php $this->renderPartial("application.views.layouts.adsend");?>
            <h1 class="title-bor mag0"><strong>Điện Toán Hôm Nay</strong></h1>
            <div class="clearfix tab-optseach">
                <ul class="tab1 clearfix" id="areas_result">
                    <li class="first "><a title="Xổ số miền nam" href="<?php echo Url::createUrl("home/miennam")?>"><strong>Miền Nam</strong></a></li>
                    <li><a title="Xổ số miền trung" href="<?php echo Url::createUrl("home/mientrung")?>"><strong>Miền Trung</strong></a></li>
                    <li class="active"><a title="Xổ số điện toán" href="<?php echo Url::createUrl("home/dientoan")?>"><strong>Điện toán</strong></a></li>
                    <li><a title="Xổ số miền bắc" href="<?php echo Url::createUrl("home/mienbac")?>"><strong>Miền Bắc&nbsp;</strong></a></li>
                </ul>
            </div>

            <ul class="dientoan clearfix">
                <?php if($dt123){?>
                    <li class="first">
                        <h2 class="pad10-5"><strong>Kết Quả Xổ Số Điện Toán 123 ngày <?php echo date('d/m/Y',strtotime($dt123["ngay_quay"]))?></strong></h2>
                        <div><span><?php echo $dt123["ketqua_1"]?></span><span><?php echo $dt123["ketqua_2"]?></span><span><?php echo $dt123["ketqua_3"]?></span></div>
                    </li>
                    <?php }?>
                <?php if($thantai){?>
                    <li class="second">
                        <h2 class="pad10-5"><strong>Kết Quả Xổ Số Thần Tài ngày <?php echo date('d/m/Y',strtotime($thantai["ngay_quay"]))?></strong></h2>
                        <div><span><?php echo $thantai["ketqua"]?></span></div>
                    </li>
                    <?php }?>
                <?php if($dt6x36){?>
                    <li class="last">
                        <h2 class="pad10-5"><strong>Kết Quả Xổ Số Điện Toán 6x36 ngày <?php echo date('d/m/Y',strtotime($dt6x36["ngay_quay"]))?></strong></h2>
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
        <div class="box cp-sms">
            
        </div>
        <div class="box pad10-5">
            <ul class="list-kq list-dot-red">
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="" href="<?php echo Url::createUrl("home/lastDientoan")?>">Kết quả điện toán hôm qua</a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="" href="<?php echo Url::createUrl("result/dientoan",array("ngay"=>date('d',time()-86400*2),"thang"=>date('m',time()-86400*2),"nam"=>date('Y',time()-86400*2)))?>">Kết quả điện toán ngày <?php echo date('d-m-Y',time()-86400*2)?></a>
                </li>
                <li>
                    <img width="6" height="6" alt="icon ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png">
                    <a title="" href="<?php echo Url::createUrl("result/dientoan",array("ngay"=>date('d',time()-86400*3),"thang"=>date('m',time()-86400*3),"nam"=>date('Y',time()-86400*3)))?>">Kết quả điện toán ngày <?php echo date('d-m-Y',time()-86400*3)?></a>
                </li>
            </ul>
        </div>
        <div class="box">
            <div class="box-nd">

                <h2 class="title-bor pad5"><strong>Cơ cấu giải thưởng Xổ số điện toán-cty XSKT Thủ đô ban hành</strong></h2>
                <div class="bg_f9 pad5"><strong>Lô tô tự chọn 2 số, 3 số, 4 số và 5 số</strong></div>
                <ul class="magb10">
                    <li class="pad5">
                        <strong>Lôtô tự chọn 2 số</strong>
                        <ul>
                            <li>
                                2 số ghi trên vé đúng với 2 số cuối giải đặc biệt của XSKT truyền thống mở thưởng cùng ngày được trúng thưởng với giá trị tiền thưởng gấp 70 lần giá trị vé mua. 
                            </li>
                        </ul>
                    </li>
                    <li class="pad5">
                        <strong>Lôtô tự chọn 3 số</strong>
                        <ul>
                            <li>
                                3 số ghi trên vé đúng với 3 số cuối giải đặc biệt của XSKT truyền thống mở thưởng cùng ngày được trúng thưởng với giá trị tiền thưởng gấp 450 lần giá trị vé mua.
                            </li>
                    </ul> </li>
                    <li class="pad5">
                        <strong>Giải khuyến khích tự chọn 3 số</strong>
                        <ul>
                            <li>Trúng 2 số cuối bằng 10 lần giá trị vé mua. </li>
                        </ul>
                    </li>
                    <li class="pad5">
                        <strong>Lôtô tự chọn 5 số</strong>
                        <ul>
                            <li>Cách chơi và cơ cấu giải thưởng tương tự như Xổ số truyền thống</li>
                        </ul>
                    </li>
                    <li class="pad5">
                        <strong>Cơ cấu giải thưởng mới</strong>
                        <ul>
                            <li>Áp dụng bắt đầu từ 01-10-2010. </li>
                        </ul>
                    </li>
                </ul>
                <div class="bg_f9 pad5"><strong>Lô tô tự chọn các cặp số (lô tô xiên)</strong></div>
                <ul class="magb10">
                    <li class="pad5"><strong>Lôtô tự chọn 2 cặp số</strong>
                        <ul>    
                            <li>Trúng cả 2 cặp số và cả 2 cặp số này trùng 2 lần quay trở lên (trong 27 lần quay) Giải thưởng gấp 15 lần giá trị vé mua </li>
                            <li>Trúng cả 2 cặp số (trong 27 lần quay): Giải thưởng gấp 10 lần giá trị vé mua </li>
                            <li>Trúng 1 trong 2 cặp số và cặp số này trùng 2 lần quay trở lên (trong 27 lần quay). Giải thưởng gấp 2 lần giá trị vé mua </li>
                        </ul>
                    </li>
                    <li class="pad5"><strong>Lôtô tự chọn 3 cặp số</strong>
                        <ul>    
                            <li>Trúng cả 3 cặp số và cả 3 cặp số này trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 50 lần giá trị vé mua </li>
                            <li>Trúng cả 3 cặp số (trong 27 lần quay): Giải thưởng gấp 45 lần giá trị vé mua </li>
                            <li>Trúng 2 trong 3 cặp số và 2 cặp số này trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 10 lần giá trị vé mua </li>
                            <li>Trúng 2 trong 3 cặp số, trong đó có 1 cặp số trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 5 lần giá trị vé mua </li>
                        </ul>
                    </li>
                    <li class="pad5"><strong>Lôtô tự chọn 4 cặp số</strong>
                        <ul>    
                            <li>Trúng cả 4 cặp số và cả 4 cặp số này trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 500 lần giá trị vé mua </li>
                            <li>Trúng cả 4 cặp số (trong 27 lần quay): Giải thưởng gấp 120 lần giá trị vé mua </li>
                            <li>Trúng 3 trong 4 cặp số và cả 3 cặp số này trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 30 lần giá trị vé mua</li>
                            <li>Trúng 3 trong 4 cặp số, trong đó có 2 cặp số trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 20 lần giá trị vé mua</li>
                            <li>Trúng 3 trong 4 cặp số, trong đó có 1 cặp số trùng 2 lần quay trở lên (Trong 27 lần quay): Giải thưởng gấp 10 lần giá trị vé mua</li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div class="pad5 note">
                <div class="s16"><strong>Lưu ý :</strong></div>      
                <ul>
                    <li class="pad5">Vé trùng nhiều giải chỉ được lĩnh giải có giá trị cao nhất. </li>
                    <li class="pad5">Các cặp số dự thưởng trên 1 tờ vé phải ghi những cặp số tự nhiên khác nhau. </li>
                </ul>
            </div>
        </div>

    </div>
</div>