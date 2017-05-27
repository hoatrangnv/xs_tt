<?php
    $detect = new MobileDetect();
    if($_SERVER["HTTP_HOST"]=="localhost"){
        $connect = Yii::app()->db;
        echo $connect->showSql;
    }
?>
<?php ?>
<div class="footer">
    <div class="main clearfix">
        <div class="fl">
            <p class="mag0">Copyright <strong>&copy; 2016</strong> by xosothanhtai.vn</p>
        </div>
    </div>
</div>

