<?php
    if(!isset($rg)) $rg = "mb";
    $hour_live = LoadConfig::$region[$rg]["hour_live"];
    $label = $province ? $province["name"] : LoadConfig::$region[$rg]["name"];
    if(!isset($next_date)) $next_date = date('d-m-Y',time()+86400);
    if($rg=="mn"){
        $title_region = "kết quả xổ số miền nam";
        $link_region = Url::createUrl("result/kqMiennam");
    }elseif($rg=="mt"){
        $title_region = "kết quả xổ số miền trung";
        $link_region = Url::createUrl("result/kqMientrung");
    }else{
        $title_region = "kết quả xổ số miền bắc";
        $link_region = Url::createUrl("result/kqMienbac");
    }
?>
<script type="text/javascript">

    var target_date = new Date('<?php echo date('Y',time()) ?>','<?php echo date('m',time()) ?>','<?php echo date('d',time()) ?>','<?php echo $hour_live?>',15,1).getTime();

    var days, hours, minutes, seconds;

    setInterval(function () {
        // find the amount of "seconds" between now and target
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;
        if(seconds_left >0){
            // do some time calculations
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;

            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;

            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);

            // format countdown string + set tag value
            $("#area_count_down").html( + hours + " giờ, " + minutes + " phút, " + seconds + " giây");  
        }

        }, 1000);
</script>
<?php if(date("H",time()) > $hour_live){?>
    <p class="mag5-0">
        <img width="8" height="9" class="mag-r5" title="" alt="ket qua ve so" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet1.png">
        Kỳ mở thưởng xổ số <?php echo $label;?> tiếp theo ngày <span class="clred"><?php echo $next_date?></span> lúc: <span class="clred"><?php echo $hour_live;?>h14'</span>
    </p>
    <?php }elseif(date("H",time()) < $hour_live){?>
    <p class="mag5-0">      
            <img width="15" height="15" alt="load vé số" src="<?php echo Yii::app()->params["static_url"]?>/images/loading2.gif"> 
            Đang chờ xổ số <?php echo $label;?> lúc <strong><?php echo $hour_live;?>h14'</strong>: <strong><?php echo date('d-m-Y',time())?></strong>. 
            Còn <span class="clred" id="area_count_down"></span>
    </p>
<?php }?>