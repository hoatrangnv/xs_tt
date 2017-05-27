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
        
            if($action=="miennam"){ 
                $content = "Tường thuật trực tiếp kết quả xổ số miền nam nhanh chóng, chính xác nhất trên xosothantai.vn";
                $link = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam");
            }elseif($action=="mientrung"){ 
                $content = "Tường thuật trực tiếp kết quả xổ số miền trung nhanh chóng, chính xác nhất trên xosothantai.vn";
                $link = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung");
            }else{ 
                $content = "Tường thuật trực tiếp kết quả xổ số miền bắc nhanh chóng, chính xác nhất trên xosothantai.vn";
                $link = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac");
            }
        ?>
        <item>
            <title><?php echo $title;?></title>
            <description><?php echo $content;?></description>
            <link><?php echo $link; ?></link>
            <pubDate><?php echo date("D, d M Y",time()).' 12:00 AM'?></pubDate>
        </item>
        <?php 
        
            foreach($data as $key=>$value){ 
                if($action=="miennam"){
                    $day = getdate(strtotime($key)); 
                    $wday = Common::getWeekDay($day["wday"]);
                    $content = "";
                    foreach($value as $result){
                        $province = $provinces[$result["province_id"]];
                        $content .= '['.$province["name"].'] '. Common::getRssMN($result); 
                    } 
                    $content .= " Để xem tường thuật kết quả xổ số miền nam vui lòng truy cập xosothantai.vn";
                    $link = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam",array("ngay"=>date('d',strtotime($key)),"thang"=>date('m',strtotime($key)),"nam"=>date('Y',strtotime($key))));
                    $create_time = date("D, d M Y",strtotime($key)).' 12:00 AM';
                    $ngay_quay = date('d/m/Y',strtotime($key)).' ('.$wday["label"].')';
                }elseif($action=="mientrung"){
                    $content = "";
                    $day = getdate(strtotime($key)); 
                    $wday = Common::getWeekDay($day["wday"]);
                    foreach($value as $result){
                        $province = $provinces[$result["province_id"]];
                        $content .= '['.$province["name"].'] '. Common::getRssMN($result); 
                    } 
                    $content .= " Để xem tường thuật kết quả xổ số miền trung vui lòng truy cập xosothantai.vn";
                    $link = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung",array("ngay"=>date('d',strtotime($key)),"thang"=>date('m',strtotime($key)),"nam"=>date('Y',strtotime($key))));
                    $create_time = date("D, d M Y",strtotime($key)).' 12:00 AM';
                    $ngay_quay = date('d/m/Y',strtotime($key)).' ('.$wday["label"].')';
                }else{
                    $day = getdate(strtotime($value["ngay_quay"])); 
                    $wday = Common::getWeekDay($day["wday"]); 
                    $province = array();
                    foreach($provinces as $prov){
                        if($prov["thu".$wday["id"]]==1 && $prov["region"]==1){
                            $province = $prov;break;
                        }
                    }
                    $content = '['.$province["name"].'] '. Common::getRssMB($value);
                    $content .= " Để xem tường thuật kết quả xổ số miền bắc vui lòng truy cập xosothantai.vn";
                    $link = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac",array("ngay"=>date('d',strtotime($key)),"thang"=>date('m',strtotime($key)),"nam"=>date('Y',strtotime($key))));
                    $create_time = date("D, d M Y",strtotime($value["ngay_quay"])).' 12:00 AM';
                    $ngay_quay = date('d/m/Y',strtotime($value["ngay_quay"])).' ('.$wday["label"].')'; 
                }
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