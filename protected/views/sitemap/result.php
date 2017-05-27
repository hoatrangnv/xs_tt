<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>

<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo Yii::app()->params["http_url"]?>/</loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>hourly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php foreach(LoadConfig::$region as $key=>$value){  
            $ngay_quay = date('d-m-Y',time());   
            if($key=="mn"){
                $action = "miennam";
                $action_kq = "kqMiennam";
                $action_wday = "miennamWday";
            }elseif($key=="mt"){
                $action = "mientrung";
                $action_kq = "kqMientrung";
                $action_wday = "mientrungWday";
            }else{
                $action = "mienbac";
                $action_kq = "kqMienbac";
                $action_wday = "mienbacWday";
            }
        ?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("home/".$action)?></loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/".$action_kq)?></loc>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/".$action_kq,array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))))?></loc>
            <lastmod><?php echo date("c",strtotime($ngay_quay));?></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.64</priority>
        </url>
    <?php }?>
    <?php foreach($provinces as $value){ 
            if($value["region"]==3){
                $action = "miennam";
                $alias = "mien-nam";
            }elseif($value["region"]==2){
                $action = "mientrung";
                $alias = "mien-trung";
            }else{
                $action = "mienbac";
                $alias = "mien-bac";
            }
        ?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/".$action,array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"]))?></loc>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <?php }?>
    <?php foreach($province_now as $value){
            $ngay_quay = date('d-m-Y',time());   
            if($value["region"]==3){
                $action = "miennam";
                $alias = "mien-nam";
            }elseif($value["region"]==2){
                $action = "mientrung";
                $alias = "mien-trung";
            }else{
                $action = "mienbac";
                $alias = "mien-bac";
            }
        ?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/".$action,array("province_name"=>$value["alias"],"code"=>$value["code"],"province_id"=>$value["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
</urlset>