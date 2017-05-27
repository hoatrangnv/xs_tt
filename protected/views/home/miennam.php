<?php
    
    $province = Common::getRandomArray($provinces,1);
    $action = Yii::app()->controller->action->id;
    $ngay_quay = !empty($ngay_quay) ? $ngay_quay : date('d-m-Y');
?>

<div class="col-l">
    <?php $this->renderPartial("application.views.module.result_in_day_top"); ?>
    <div class="box-kq">
        <div class="box">
            <?php $this->renderPartial("application.views.layouts.adsend");?>
            <h1 class="title-bor mag0">
                <strong>
                    <?php 
                        if($action!="index"){
                            echo "Kết quả xổ số miền nam hôm nay";
                        }else{
                            echo "Kết quả xổ số hôm nay";
                        }
                    ?>
                </strong>
            </h1>
            <div class="clearfix tab-optseach">
                <ul class="tab1 clearfix" id="areas_result">
                    <li class="first active"><a title="Xổ số miền nam" href="<?php echo Url::createUrl("home/miennam")?>"><strong>Miền Nam</strong></a></li>
                    <li><a title="Xổ số miền trung" href="<?php echo Url::createUrl("home/mientrung")?>"><strong>Miền Trung</strong></a></li>
                    <li><a title="Xổ số điện toán" href="<?php echo Url::createUrl("home/dientoan")?>"><strong>Điện toán</strong></a></li>
                    <li><a title="Xổ số miền bắc" href="<?php echo Url::createUrl("home/mienbac")?>"><strong>Miền Bắc&nbsp;</strong></a></li>
                </ul>
            </div>

            <?php
               
                if(date('N',time())==6){
                    $class = "four"; 
                }else{
                    $class = "three";
                }
                if(date('H',time())==LoadConfig::$region["mn"]["hour_live"]){

                    $class_tuongthuat = $class.'-city';
                }else{
                    $class_tuongthuat = '';
                }
            ?>

            <div class="<?php echo $class_tuongthuat;?>" id="load_kq_mn">
                <?php 
                    foreach($provinces as $province){

                        $id = $province["id"];
                        $date = getdate(strtotime($data[$id]["ngay_quay"]));
                        $day = Common::getWeekDay($date["wday"]);
                    ?>
                    <div class="tit-mien clearfix">
                        <h2 class="txt-center">
                            Kết quả xổ số <?php echo $province["name"]?> ngày <?php echo date('d/m/Y',strtotime($ngay_quay))?> <?php echo $day["label"]?> - XS<?php echo strtoupper($province["code"])?>
                        </h2>
                    </div>
                    <div class="col-2 clearfix">
                        <?php $this->renderPartial("application.views.result.load_kq_tinh",array("data"=>$data[$id],"loto"=>$loto[$id],"province"=>$province))?>
                    </div>  
                    <br/>
                    <?php }?> 
            </div>
            <div class="cp-sms">
               
            </div>
        </div>
        <div class="conect_out pad5"> 
            <?php 
                if(date('H')!=LoadConfig::$region["mn"]["hour_live"]){
                    $this->renderPartial("application.views.layouts.social_home");
                }
            ?>   
            <?php $url_print = Url::createUrl("print/index",array("region"=>3,"ngay_quay"=>isset($ngay_quay) ? date('d-m-Y',strtotime($ngay_quay)):date('d-m-Y',time())))?>     
            <span class="bg_brown"></span>
            <span class="bg_brown"></span> 
        </div>
        <div class="txt-center">
            <?php 
                $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"));
            ?>
        </div>
        <?php $this->renderPartial("application.views.module.result_yesterday",array("region"=>3))?>
        <div class="box loto-<?php echo $class;?>">
            <div class="clearfix tab-optseach">  
                <ul class="tab1 clearfix">
                    <?php
                        $i = 0; 
                        foreach($provinces as $value){
                            $i++;
                        ?>
                        <li id="i_tkloto_<?php echo $value["id"]?>" class="c_tkloto <?php $i==1 ? 'first':''?> <?php echo $first_province["id"]==$value["id"] ? 'active':''?>">
                            <a rel="nofollow" href="javascript:void(0)" onclick="loadThongkeBoso('<?php echo $value["id"];?>')">Loto<br><strong><?php echo $value["name"]?> &nbsp;</strong></a>
                        </li>
                        <?php }?>
                </ul>
            </div>
            <div id="tk_loto">
                <?php $this->renderPartial("load_tk_boso",
                        array(
                            "first_province"=>$first_province
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

    function loadKetquaMiennam(strUrl){
        $.ajax({
            type: "GET",
            url: strUrl,
            data: {},
            beforeSend : function(){
                var text = $("#load_kq_mn").html();
                $("#load_kq_mn").html(text);
            },
            error: function(request,error) 
            {
                var text = $("#load_kq_mn").html();
                $("#load_kq_mn").html(text);
            },
            success: function(msg){  
                if(msg !=""){
                    $("#load_kq_mn").html(msg);
                }          
            }
        });
    }
    function loadThongkeBoso(province_id){
        $.ajax({
            type: "POST",
            url: '<?php echo Url::createUrl("home/loadThongkeBoso")?>',
            data: {
                province_id:province_id 
            },
            beforeSend: function(){
                $(".c_tkloto").removeClass("active");
                $("#i_tkloto_"+province_id).addClass("active");
            }, 
            success: function(msg){ 
                $("#tk_loto").html(msg);          
            }
        });
    }
    function loadMiennam(){           
        var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;  
        if(is_chrome){
            var t = new Date().getTime();
        }else{
            var t = new Date('<?php echo date('Y')?>','<?php echo date('m')?>','<?php echo date('d')?>').getTime();
        } 
        var t = new Date().getTime();               
        var strUrl = '/kkt_api/livexs/MienNamTT.html?t='+t;
        loadKetquaMiennam(strUrl); 
    }

    
        $(document).ready(function(){
            <?php if(date('H',time())==LoadConfig::$region["mn"]["hour_live"]){?>
            loadMiennam();
            setInterval(
                function(){
                    loadMiennam();
                },1000
            ); 
            <?php }?>
            
        }); 
        

</script>