<?php
    $url_region = Url::createUrl("result/kqMienbac");
?>

<div class="conten-right">
    <h2><strong>Xổ số miền bắc</strong></h2>

    <ul>
        <li>
            <img width="10" height="10" alt="Kết quả xổ số miền bắc" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
            <a title="Kết quả xổ số miền bắc" href="<?php echo $url_region;?>"><strong>Miền bắc</strong></a>
        </li>  
        <li class="">
            <img width="10" height="10" alt="Kết quả xổ số điện toán" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet2.png">
            <a title="Kết quả điện toán" href="<?php echo Url::createUrl("result/dientoan")?>"><strong>Điện toán</strong></a>
        </li>
    </ul>
</div>
