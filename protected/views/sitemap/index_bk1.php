<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo Yii::app()->params["http_url"]?>/</loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>1.0</priority>
    </url>

    <?php foreach(LoadConfig::$region as $key=>$value){  
            $ngay_quay = date('d-m-Y');   
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
            <changefreq>always</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/".$action_kq)?></loc>
            <changefreq>always</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("result/".$action_kq,array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))))?></loc>
            <lastmod><?php echo date("c",strtotime($ngay_quay));?></lastmod>
            <changefreq>always</changefreq>
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
            <changefreq>always</changefreq>
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
            <changefreq>always</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <?php foreach($provinces as $value){?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("province_name"=>$value["alias"],"province_id"=>$value["id"]))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>always</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyDacbiet")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyDacbiet",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyDacbiet",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyDacbiet",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyXien")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyXien",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyXien",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/chukyXien",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <?php foreach($provinces as $value){?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("province_name"=>$value["alias"],"province_id"=>$value["id"]))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>always</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansoNhipLoto")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansoNhipLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansoNhipLoto",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansoNhipLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tongBoso")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tongBoso",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tongBoso",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tongBoso",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/day")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/day",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/day",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/day",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghopDacbiet")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghopDacbiet",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghopDacbiet",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghopDacbiet",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-nam"))?></loc>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatCapLoto")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatCapLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatCapLoto",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatCapLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <?php foreach($provinces as $value){?>
        <url>
            <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("province_name"=>$value["alias"],"province_id"=>$value["id"]))?></loc>
            <lastmod><?php echo date("c",time());?></lastmod>
            <changefreq>always</changefreq>
            <priority>0.64</priority>
        </url>
        <?php }?>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatBoso")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatBoso",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatBoso",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatBoso",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>

    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop")?></loc>
        <changefreq>always</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop",array("region"=>"mien-bac"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop",array("region"=>"mien-nam"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop",array("region"=>"mien-trung"))?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>  
    
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("dreambook/index")?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("rss/index")?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
    
    <url>
        <loc><?php echo Yii::app()->params["http_url"].Url::createUrl("news/index")?></loc>
        <lastmod><?php echo date("c",time());?></lastmod>
        <changefreq>always</changefreq>
        <priority>0.64</priority>
    </url>
</urlset>