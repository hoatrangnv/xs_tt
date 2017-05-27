<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>

<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <?php foreach($provinces as $value){?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("province_name"=>$value["alias"],"province_id"=>$value["id"]))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <?php foreach($provinces as $value){?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("province_name"=>$value["alias"],"province_id"=>$value["id"]))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-nam"))?></loc>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <?php foreach($provinces as $value){?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("province_name"=>$value["alias"],"province_id"=>$value["id"]))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop")?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.64</priority>
    </url>
</urlset>