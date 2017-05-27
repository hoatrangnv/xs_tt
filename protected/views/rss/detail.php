<?php
    header("Content-Type: application/xml; charset=UTF-8");
    echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0">
    <channel>
        <title><?php echo $title;?> - RSS</title>
        <description><?php echo $title;?> - RSS - <?php echo $tit;?></description>
        <link><?php echo Common::getCurrentUrl()?></link>
        <copyright>xosothantai.vn</copyright>
        <generator>xosothantai.vn:http://xosothantai.vn/rss</generator>
        <pubDate><?php echo date("D, d M Y H:i:s",time())?></pubDate>
        <lastBuildDate><?php echo date("D, d M Y H:i:s")?></lastBuildDate>
        <?php 
        
            if($province["region"]==3){ 
                $link = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
            }elseif($province["region"]==2){ 
                $link = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
            }else{ 
                $link = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
            }
            $content = "Tường thuật trực tiếp kết quả xổ số ".$province["name"]." nhanh chóng, chính xác nhất trên xosothantai.vn";
        ?>
        <item>
            <title><?php echo $title;?></title>
            <description><?php echo $content;?></description>
            <link><?php echo $link; ?></link>
            <pubDate><?php echo date("D, d M Y",time()).' 12:00 AM'?></pubDate>
        </item>
        <?php foreach($data as $key=>$value){ 
                $day = getdate(strtotime($value["ngay_quay"])); 
                $wday = Common::getWeekDay($day["wday"]);
                if($province["region"]==3){
                    $content = '['.$province["name"].'] '. Common::getRssMN($value);
                    $action = "miennam";
                }elseif($province["region"]==2){
                    $content = '['.$province["name"].'] '. Common::getRssMT($value);
                    $action = "mientrung";
                }else{
                    $content = '['.$province["name"].'] '. Common::getRssMB($value);
                    $action = "mienbac";
                }
                $content .= " Để theo dõi kết quả xổ số ".$province["name"]." hàng tuần vui lòng truy cập xosothantai.vn";
                $link = Yii::app()->params["http_url"].Url::createUrl("result/".$action,array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($value["ngay_quay"])),"thang"=>date('m',strtotime($value["ngay_quay"])),"nam"=>date('Y',strtotime($value["ngay_quay"]))));
                $create_time = date("D, d M Y",strtotime($value["ngay_quay"])).' 12:00 AM';
                $ngay_quay = date('d/m/Y',strtotime($value["ngay_quay"])).' ('.$wday["label"].')'; 
            ?> 
            <item>
                <title><?php echo $title;?> Ngày <?php echo $ngay_quay;?></title>
                <description><?php echo $content;?></description>
                <link><?php echo $link; ?></link>
                <pubDate><?php echo $create_time?></pubDate>
            </item>
            <?php }?>
    </channel>
</rss>
