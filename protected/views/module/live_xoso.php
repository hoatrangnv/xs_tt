<?php
    $live = "";
    if(date('H',time())==LoadConfig::$region["mn"]["hour_live"]){
        $live ="mn";
    }elseif(date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
        $live ="mt";
    }elseif(date('H',time())==LoadConfig::$region["mb"]["hour_live"]){
        $live ="mb";
    }
?>
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
    </ul>
</div>