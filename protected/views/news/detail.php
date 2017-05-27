
<div class="col-l">
    <div class="box news-detail">

        <div class="box-detail">
            <h1><strong><?php echo $data["title"]?></strong></h1>
            <div class="conect_out pad5">
                <?php //$this->renderPartial("application.views.layouts.social");?>
            </div>
            <p><strong><?php echo $data["introtext"]?></strong></p>
            <div class="txt-center">
                <?php 
                    $this->renderPartial("application.views.layouts.adsend");
                ?>
            </div>
            <?php 
                $desc = $data["description"];
                $desc = str_replace(' src="/upload/editor/',' src="'.Yii::app()->params["urlImages"].'editor/',$desc);
                echo $desc;
            ?>
            <?php $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"))?>
        </div>

    </div>
    <div class="box box-news">
        <h3 class="title-bor">Tin tức xổ số liên quan</h3>
        <ul>
            <?php 
                foreach($data_other as $value){
                    $link_detail = Url::createUrl("news/detail",array("alias"=>$value["alias"],"news_id"=>$value["id"]));
                ?>
                <li><span class="ic"></span>
                    <a href="<?php echo $link_detail;?>" title="<?php echo $value["title"]?>"><?php echo $value["title"]?></a>
                </li>
                <?php }?>
        </ul>
    </div>
</div>