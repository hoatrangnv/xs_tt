<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <sitemap>
        <loc><?php echo Yii::app()->params['http_url'].Url::createUrl("sitemap/result"); ?></loc>
    </sitemap>
    <sitemap>
        <loc><?php echo Yii::app()->params['http_url'].Url::createUrl("sitemap/thongke"); ?></loc>
    </sitemap>
    <?php
        $current_month = date('n',time()); 
        $year = date('Y');
        for($i = $current_month; $i >= 1; $i--){
        ?>
        <sitemap>
            <loc><?php echo Yii::app()->params['http_url'].Url::createUrl("sitemap/month",array("month"=>$i,"year"=>$year)); ?></loc>
        </sitemap>
        
        <?php }?>
    
</sitemapindex>