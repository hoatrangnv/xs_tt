<?php
    $folder_img = "news_xosome";
?>
<div class="col-l">
    <div class="box cate-news">
        <h1 class="title-bor mag0"><strong><?php echo $title;?></strong></h1>
        <div class="bg_f9">
            <form action="http://www.google.com.vn" id="cse-search-box">
                <div class="box-search clearfix">
                    <input type="hidden" name="cx" value="partner-pub-3084353470359421:6577812195" />
                    <input type="hidden" name="ie" value="UTF-8" />
                    <div class="bor-1 fl"><input type="text" name="q" /></div>
                    <button type="submit" class="fl"><strong>Tìm kiếm</strong></button>
                </div>
            </form>
            <script type="text/javascript" src="http://www.google.com.vn/coop/cse/brand?form=cse-search-box&amp;lang=vi"></script>

        </div>
        <?php 
            $this->renderPartial("application.views.layouts.adsend");
        ?>
        <ul>
            <?php 
                foreach($data as $value){
                    $link_img = Common::getImage($value["picture"],$folder_img,$value["create_date"]);
                    $img_error = Common::getImgError(); 
                    $link_detail = Url::createUrl("news/detail",array("alias"=>$value["alias"],"news_id"=>$value["id"]));  
                ?>
                <li class="clearfix">
                    <a href="<?php echo $link_detail;?>">
                        <img width="120" class="mag-r5 fl" alt="" src="<?php echo $link_img?>" onerror="this.src='<?php echo $img_error;?>'">
                    </a>
                    <h3><a title="<?php echo $value["title"]?>" href="<?php echo $link_detail;?>"><?php echo $value["title"]?></a></h3>
                    <p class="mag0 date cl9"><?php echo Common::getDateFormat($value["create_date"])?></p>
                    <p class="mag0 sapo"><?php echo $value["introtext"]?></p>
                </li>
                <?php }?>
        </ul>

        <div class="paging txt-center magb10">
            <?php     
                if($keyword==""){
                    $path = str_replace(".html","",$path);
                    echo Paging::showPageNavigation($page,$max_page,$path."/");
                }else{
                    $current_url = Common::getCurrentUrl();
                    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
                    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
                    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
                    echo Paging::showPageNavigationNoRewrite($page,$max_page,$path_paging);
                }          
            ?>
        </div>
        <?php $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"))?>
    </div>
</div>