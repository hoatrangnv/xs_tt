<?php 
    $control = Yii::app()->controller->id;
?>   
<div class="<?php echo $control=="statistic" ? 'col-center':'col-right'?>">
    <div class="box">
        
        <div class="conten-right">
            <h3><strong>Tường thuật trực tiếp xổ số</strong></h3>
            <ul class="lottery-now">
                <li>
                    <span class="ic"></span><a href="<?php echo Url::createUrl("home/mienbac")?>" title="Trực tiếp xổ số Miền Bắc">Trực tiếp xổ số Miền Bắc</a>
                    <?php if($live=="mb"){?>
                        <img src="<?php echo Yii::app()->params["static_url"]?>/images/loading2.gif" width="15" height="15" alt="trực tiếp kết quả xổ số miền bắc" class="mag-l5" />
                        <?php }?>
                </li>
                <li>
                    <span class="ic"></span><a href="<?php echo Url::createUrl("home/miennam")?>" title="Trực tiếp xổ số Miền Nam">Trực tiếp xổ số Miền Nam</a>
                    <?php if($live=="mn"){?>
                        <img src="<?php echo Yii::app()->params["static_url"]?>/images/loading2.gif" width="15" height="15" alt="trực tiếp kết quả xổ số miền nam" class="mag-l5" />
                        <?php }?>
                </li>
                <li>
                    <span class="ic"></span><a href="<?php echo Url::createUrl("home/mientrung")?>" title="Trực tiếp xổ số Miền Trung">Trực tiếp xổ số Miền Trung</a>
                    <?php if($live=="mt"){?>
                        <img src="<?php echo Yii::app()->params["static_url"]?>/images/loading2.gif" width="15" height="15" alt="trực tiếp kết quả xổ số miền trung" class="mag-l5" />
                        <?php }?>
                </li>
                <li><span class="ic"></span><a href="<?php echo Url::createUrl("dudoan/index")?>" title="Dự đoán kết quả xổ số">Dự đoán kết quả xổ số</a></li>
                <li><span class="ic"></span><a href="<?php echo Url::createUrl("home/calendar")?>" title="Lịch quay xổ số">Lịch quay xổ số</a></li>
            </ul>
        </div>
        <div class="conten-right">
            <h3><strong>Tết Nguyên Đán</strong></h3>
            <ul class="lottery-now">
                <?php
                    $i =0;
                    foreach(LoadConfig::$event_news as $key=>$value){
                        $i++;
                    ?>
                    <li class="<?php echo $i==count(LoadConfig::$event_news) ? 'nobor' :''?>">
                        <span class="ic"></span>
                        <a href="<?php echo Url::createUrl("news/event",array("alias"=>$value["alias"],"eventId"=>$key))?>" title="<?php echo $value["title"];?>"><?php echo $value["title"];?></a>
                    </li>
                    <?php }?>
            </ul>
        </div>
        <?php if($control=="tuvi"){?>
            <div class="conten-right">
                <h3><strong>Tử Vi 12 Con Giáp</strong></h3>
                <ul class="lottery-now">
                    <?php
                        $i =0;
                        foreach(LoadConfig::$event_tuvi as $key=>$value){
                            $i++;
                        ?>
                        <li class="<?php echo $i==count(LoadConfig::$tuvi_cat) ? 'nobor' :''?>">
                            <span class="ic"></span>
                            <a href="<?php echo Url::createUrl("tuvi/event",array("alias"=>$value["alias"],"eventId"=>$key))?>" title="<?php echo $value["title"];?>"><?php echo $value["title"];?></a>
                        </li>
                        <?php }?>
                </ul>
            </div>
            <?php }else{?>
            <div class="conten-right">
                <h3><strong>Thống kê kết quả xổ số</strong></h3>
                <ul class="stastic-lotery">
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/chukyLoto")?>" title="Thống kê chu kỳ loto">Thống kê chu kỳ loto</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tansoNhipLoto")?>" title="Thống kê tần số nhịp loto">Thống kê tần số nhịp loto</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/dauduoiLoto")?>" title="Thống kê đầu đuôi loto">Thống kê đầu đuôi loto</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/chukyDacbiet")?>" title="Thống kê chu kỳ đặc biệt">Thống kê chu kỳ đặc biệt</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/dacbiet")?>" title="Thống kê giải đặc biệt">Thống kê giải đặc biệt</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/dauduoiDacbiet")?>" title="Thống kê đầu đuôi đặc biệt">Thống kê đầu đuôi đặc biệt</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tansuatLoto")?>" title="Thống kê tần suất loto">Thống kê tần suất loto</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tansuatBoso")?>" title="Thống kê tần suất các bộ số">Thống kê tần suất các bộ số</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tansuatCapLoto")?>" title="Thống kê tần suất cặp loto">Thống kê tần suất cặp loto</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/nhanh")?>" title="Thống kê nhanh">Thống kê nhanh</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/chukyXien")?>" title="Thống kê chu kỳ loto xiên">Thống kê chu kỳ loto xiên</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/day")?>" title="Thống kê theo ngày">Thống kê theo ngày</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tonghop")?>" title="Thống kê tổng hợp">Thống kê tổng hợp</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tongBoso")?>" title="Thống kê theo tổng">Thống kê theo tổng</a></li>
                    <li><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/tonghopDacbiet")?>" title="Tổng hợp chu kỳ đặc biệt">Tổng hợp chu kỳ đặc biệt</a></li>
                    <li class="nobor"><span class="ic"></span><a href="<?php echo Url::createUrl("statistic/lotoGan")?>" title="Thống kê loto gan">Thống kê loto gan</a></li>
                </ul>
            </div>
            <?php }?>
           
    </div>
    <!--<div class="box adv">
    <img src="<?php echo Yii::app()->params["static_url"]?>/demo/bn-200.png" />
    </div>  -->
      </div>