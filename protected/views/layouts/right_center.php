<?php
    $regions = LoadConfig::$region;
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    
    $regions_rule = array("mb","mn","mt");
    $region_id = "mb";
    if(in_array($action,array("miennam","miennamWday","kqMiennam")) || date('H',time())==LoadConfig::$region["mn"]["hour_live"]){
        $regions_rule = array("mn","mt","mb");
        $region_id = "mn";
    }elseif(in_array($action,array("mientrung","mientrungWday","kqMientrung")) || date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
        $regions_rule = array("mt","mn","mb");
        $region_id = "mt";
    }

?>
<script type="text/javascript">
    function showPredict(region){
        if($("."+region+"_predic_0").css("display")=="none"){
            $(".cl_predict").removeClass("arr-top");
            $(".cl_predict").addClass("arr-btt");
            $("."+region+"_predic_0").show(); 
        }else{
            $(".cl_predict").removeClass("arr-btt");
            $(".cl_predict").addClass("arr-top");
            $("."+region+"_predic_0").hide();
        }
    }
    function showProvince(region){
        if($("."+region+"_p_0").css("display")=="none"){
            $(".cl_region").removeClass("arr-top");
            $(".cl_region").addClass("arr-btt");
            $("."+region+"_p_0").show(); 
        }else{
            $(".cl_region").removeClass("arr-btt");
            $(".cl_region").addClass("arr-top");
            $("."+region+"_p_0").hide();
        }
    }
</script>
<div class="col-center">
    <div class="box">
        <?php
            foreach($regions_rule as $rg){
                 $this->renderPartial("application.views.module.xoso_".$rg);
            }
            /*$province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]) : 1;
            if($control=="home"){
                $this->renderPartial("application.views.module.dudoan");
                $this->renderPartial("application.views.module.result_in_day");
                $this->renderPartial("application.views.module.result_wday");  
                if($action=="index"){
                    $this->renderPartial("application.views.module.right_news",array("category_id"=>8,"content_id"=>1,"title_box"=>"Tin Tức Bóng Đá")); 
                } 
            }elseif($control=="result"){
                if(!in_array($action,array("mienbac","miennam","mientrung"))){
                    $this->renderPartial("application.views.module.dudoan");
                    $this->renderPartial("application.views.module.result_in_day");
                    $this->renderPartial("application.views.module.result_wday");  
                    $this->renderPartial("application.views.module.right_news",array("category_id"=>0,"content_id"=>0,"title_box"=>"Tin Tức Xổ Số")); 
                }else{
                    $this->renderPartial("application.views.module.dudoan");
                    $this->renderPartial("application.views.module.result_in_day");
                    $this->renderPartial("application.views.module.right_news",array("category_id"=>0,"content_id"=>$province_id,"title_box"=>"Tin tức xổ số"));
                }
            }elseif($control=="quayso"){
                $this->renderPartial("application.views.module.dudoan");
                $this->renderPartial("application.views.module.result_in_day");
                $this->renderPartial("application.views.module.right_news",array("category_id"=>6,"content_id"=>2,"title_box"=>"Xem vận hạn"));
            }elseif($control=="dreambook"){
                $this->renderPartial("application.views.module.dudoan");
                $this->renderPartial("application.views.module.result_in_day");
                $this->renderPartial("application.views.module.right_news",array("category_id"=>0,"content_id"=>$province_id,"title_box"=>"Tin tức xổ số"));
            }elseif($control=="soicau"){
                $this->renderPartial("application.views.module.soicau");
                $this->renderPartial("application.views.module.result_in_day");
                $this->renderPartial("application.views.module.right_news",array("category_id"=>0,"content_id"=>$province_id,"title_box"=>"Tin tức xổ số"));
            }elseif($control=="xemtuong"){
                $this->renderPartial("application.views.module.cat_xemtuong");
                $this->renderPartial("application.views.module.cat_tuvi");
                $this->renderPartial("application.views.module.right_news",array("category_id"=>6,"content_id"=>2,"title_box"=>"Xem ngày vận hạn"));
            }elseif($control=="tuvi"){
                $this->renderPartial("application.views.module.cat_tuvi");
                $this->renderPartial("application.views.module.banner");
                $this->renderPartial("application.views.module.right_news",array("category_id"=>6,"content_id"=>2,"title_box"=>"Xem ngày vận hạn"));
            }else{
                $this->renderPartial("application.views.module.dudoan");
                $this->renderPartial("application.views.module.result_in_day");
                $this->renderPartial("application.views.module.event_news");
            }*/ 
        ?>
    </div>
</div>