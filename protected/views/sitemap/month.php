<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php 
        if($month==date('m') && $year==date('Y')){
            $d = date('d');
        }else{
            $d =  cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        for($i=$d;$i>0;$i--){
            $time = mktime(0,0,0,$month,$i,$year);
        ?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac",array("ngay"=>date('d',$time),"thang"=>date('m',$time),"nam"=>date('Y',$time)))?></loc>
            <lastmod><?php echo date("c",$time);?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam",array("ngay"=>date('d',$time),"thang"=>date('m',$time),"nam"=>date('Y',$time)))?></loc>
            <lastmod><?php echo date("c",$time);?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung",array("ngay"=>date('d',$time),"thang"=>date('m',$time),"nam"=>date('Y',$time)))?></loc>
            <lastmod><?php echo date("c",$time);?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
</urlset>