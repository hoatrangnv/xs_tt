<?php
    
    $province = Common::getRandomArray($provinces,1);
    $action = Yii::app()->controller->action->id;
    $ngay_quay = isset($data["ngay_quay"]) ? date('d-m-Y',strtotime($data["ngay_quay"])):date('d-m-Y',time());
    $date = getdate(strtotime($ngay_quay));
    $day = Common::getWeekDay($date["wday"]);
?>
<div class="col-l">
    <?php $this->renderPartial("application.views.module.result_in_day_top"); ?>
    <div class="box-kq">
        <div class="box">
            <?php $this->renderPartial("application.views.layouts.adsend"); ?>
            <h1 class="title-bor mag0">
                <strong>

                    <?php 
                        if($action!="index"){
                            echo "Kết quả xổ số miền bắc hôm nay";
                        }else{
                            echo "Kết quả xổ số hôm nay";
                        }
                    ?>
                </strong>
            </h1>
            <div class="clearfix tab-optseach">
                <ul class="tab1 clearfix" id="areas_result">
                    <li class="first"><a title="Xổ số miền nam" href="<?php echo Url::createUrl("home/miennam")?>"><strong>Miền Nam</strong></a></li>
                    <li><a title="Xổ số miền trung" href="<?php echo Url::createUrl("home/mientrung")?>"><strong>Miền Trung</strong></a></li>
                    <li><a title="Xổ số điện toán" href="<?php echo Url::createUrl("home/dientoan")?>"><strong>Điện toán</strong></a></li>
                    <li class="active"><a title="Xổ số miền bắc" href="<?php echo Url::createUrl("home/mienbac")?>"><strong>Miền Bắc&nbsp;</strong></a></li>
                </ul>
            </div>

            <div class="tit-mien clearfix">
                <h2 class="txt-center">
                    Kết quả xổ số miền bắc ngày <?php echo date('d/m/Y',strtotime($ngay_quay))?> <?php echo $day["label"]?> - XSMB
                </h2>
            </div>

            <div class="col-2 clearfix" id="load_kq_mb">
                <?php $this->renderPartial("load_kqmb",array("data"=>$data,"loto"=>$loto,"province"=>reset($provinces)))?>
            </div>  
            <div class="cp-sms">
               
            </div>

        </div>  

        <div class="conect_out pad5"> 
            <?php 
                if(date('H')!=LoadConfig::$region["mb"]["hour_live"]){
                    $this->renderPartial("application.views.layouts.social_home");
                }
            ?>
            <?php $url_print = Url::createUrl("print/index",array("region"=>1,"ngay_quay"=>$ngay_quay))?>     
            <span class="bg_brown">&nbsp;</span>
            <span class="bg_brown">&nbsp</span> 
        </div>
        <div class="txt-center">
            <?php 
                $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"));
            ?>
        </div>
        <?php $this->renderPartial("application.views.module.result_yesterday",array("region"=>1))?>

        <div class="box loto-mb">

            <div id="tk_loto">
                <?php $this->renderPartial("load_tk_boso",
                        array(
                            "first_province"=>array("name"=>"Miền Bắc","id"=>1)
                            ,"data_tk10"=>$data_tk10
                            ,"data_tk20"=>$data_tk20
                            ,"data_gan"=>$data_gan
                        )
                    )
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function loadKetquaMienbac(strUrl){
        $.ajax({
            type: "GET",
            url: strUrl,
            data: "",
            beforeSend : function(){
                var text = $("#load_kq_mb").html();
                $("#load_kq_mb").html(text);
            },
            error: function(request,error) 
            {
                var text = $("#load_kq_mb").html();
                $("#load_kq_mb").html(text);
            },
            success: function(msg){  
                if(msg !=""){
                    $("#load_kq_mb").html(msg); 
                }         
            }
        });
    }
    function loadMienbac(){
        var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;  
        if(is_chrome){
            var t = new Date().getTime();
        }else{
            var t = new Date('<?php echo date('Y')?>','<?php echo date('m')?>','<?php echo date('d')?>').getTime();
        }             
         var strUrl = '/kkt_api/livexs/MienBacTT.html?t='+t;   
        loadKetquaMienbac(strUrl); 
    }

    
        $(document).ready(function(){
            <?php  if(date('H',time())==LoadConfig::$region["mb"]["hour_live"]){?> 
            loadMienbac();
            setInterval(
                function(){
                    loadMienbac();
                },1000
            ); 
            <?php }?>
            
        });
        
        
        
</script>