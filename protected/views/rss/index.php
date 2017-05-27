<div class="col-l">

    <div class="box">
        <h1 class="title-bor">Rss của xosothantai.vn</h1>
        <div class="pad10-5">
            <p class="mag0">RSS (viết tắt từ Really Simple Syndication) là một tiêu chuẩn định dạng tài liệu dựa trên XML nhằm giúp người sử dụng dễ dàng cập nhật và tra cứu thông tin một cách nhanh chóng và thuận tiện nhất bằng cách tóm lược thông tin vào trong một đoạn dữ liệu ngắn gọn, hợp chuẩn. Dữ liệu này được các chương trình đọc tin chuyên biệt (gọi là News reader) phân tích và hiển thị trên máy tính của người sử dụng. Trên trình đọc tin này, người sử dụng có thể thấy những tin chính mới nhất, tiêu đề, tóm tắt và cả đường link để xem tòan bộ tin. </p>
        </div>
    </div>
    <div class="box box-rss">    
        <h2 class="pad10-5">Các kênh do xosothantai.vn cung cấp</h2>
        <div class="list-rss">
            <ul>
                <?php
                    $url_rss = Yii::app()->params["http_url"].Url::createUrl("rss/region",array("alias"=>"mien-bac"));
                    $url_yahoo = 'http://add.my.yahoo.com/rss?url='.$url_rss;
                ?>
                <li class="pad5 bordash">
                    <a class="ic rss2" title="" href="<?php echo $url_rss;?>"></a>
                    <a class="ic ic-myy" title="" href="<?php echo $url_yahoo;?>"></a>
                    <a title="Rss Xổ Số Miền Bắc" href="<?php echo $url_rss;?>"><strong class="clred">Rss Xổ Số Miền Bắc</strong></a>
                    <a title="" href="<?php echo $url_rss;?>">(<?php echo $url_rss;?>)</a>
                </li>
                
                <?php
                    $url_rss = Yii::app()->params["http_url"].Url::createUrl("rss/region",array("alias"=>"mien-nam"));
                    $url_yahoo = 'http://add.my.yahoo.com/rss?url='.$url_rss;
                ?>
                <li class="pad5 bordash">
                    <a class="ic rss2" title="" href="<?php echo $url_rss;?>"></a>
                    <a class="ic ic-myy" title="" href="<?php echo $url_yahoo;?>"></a>
                    <a title="Rss Xổ Số Miền Nam" href="<?php echo $url_rss;?>"><strong class="clred">Rss Xổ Số Miền Nam</strong></a>
                    <a title="" href="<?php echo $url_rss;?>">(<?php echo $url_rss;?>)</a>
                </li>
                
                <?php
                    $url_rss = Yii::app()->params["http_url"].Url::createUrl("rss/region",array("alias"=>"mien-trung"));
                    $url_yahoo = 'http://add.my.yahoo.com/rss?url='.$url_rss;
                ?>
                <li class="pad5 bordash">
                    <a class="ic rss2" title="" href="<?php echo $url_rss;?>"></a>
                    <a class="ic ic-myy" title="" href="<?php echo $url_yahoo;?>"></a>
                    <a title="Rss Xổ Số Miền Trung" href="<?php echo $url_rss;?>"><strong class="clred">Rss Xổ Số Miền Trung</strong></a>
                    <a title="" href="<?php echo $url_rss;?>">(<?php echo $url_rss;?>)</a>
                </li>
                <?php foreach($provinces as $value){
                        $url_rss = Yii::app()->params["http_url"].Url::createUrl("rss/detail",array("alias"=>$value["alias"],"province_id"=>$value["id"]));
                        $url_yahoo = 'http://add.my.yahoo.com/rss?url='.$url_rss
                    ?>
                    <li class="pad5 bordash">
                        <a class="ic rss2" title="" href="<?php echo $url_rss;?>"></a>
                        <a class="ic ic-myy" title="" href="<?php echo $url_yahoo;?>"></a>
                        <a title="Rss Xổ Số <?php echo $value["name"]?>" href="<?php echo $url_rss;?>"><strong class="clred">Rss Xổ Số <?php echo $value["name"]?></strong></a>
                        <a title="" href="<?php echo $url_rss;?>">(<?php echo $url_rss;?>)</a>
                    </li>
                    <?php }?>

            </ul>

        </div>

    </div>
    <div class="box pad10">
        <p class="mag0"><strong>Các giới hạn sử dụng</strong></p>
        <p>Các nguồn kênh tin được cung cấp miễn phí cho các cá nhân và các tổ chức phi lợi nhuận. Chúng tôi yêu cầu bạn cung cấp rõ các thông tin cần thiết khi bạn sử dụng các nguồn kênh tin này từ xosothantai.vn.</p>
        <p>xosothantai.vn có quyền yêu cầu bạn ngừng cung cấp và phân tán thông tin dưới dạng này ở bất kỳ thời điểm nào và với bất kỳ lý do nào. </p>
    </div>
</div>