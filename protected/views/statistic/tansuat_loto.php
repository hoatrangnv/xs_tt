<script type="text/javascript">
    $(function(){
        $( "#from_date" ).datepicker({
            dateFormat: 'dd-mm-yy',   
            changeMonth: true,
            changeYear: true,
            showAnim:'fold', 
            buttonText :false
        });
        $( "#to_date" ).datepicker({
            dateFormat: 'dd-mm-yy', 
            changeMonth: true,
            changeYear: true,
            showAnim:'fold', 
            buttonText :false
        });
        $( ".tt_boso" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
    });
    function check_all(){                                                                                                                
        $("input[type='checkbox']").attr('checked', true);                        
    }

    function uncheck_all(){                          
        $("input[type='checkbox']").removeAttr("checked");                       
    }
</script>
<div class="col-l">
    <?php $this->renderPartial("application.views.module.adsense_top"); ?>
    <div class="box statis-loto">  
        <h1 class="title-bor mag0">
            <?php if(isset($_GET["province_id"])){?>
                <strong>Thống kê tần suất loto <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê tần suất loto <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê tần suất loto </strong>
                <?php }?>
        </h1>  
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class="first active">
                    <h2><a title="Thống kê tần suất loto" href="<?php echo Url::createUrl("statistic/tansuatLoto")?>"><strong>TK tần suất loto</strong></a></h2>
                </li>
                <li><h2><a title="Thống kê đầu đuôi loto" href="<?php echo Url::createUrl("statistic/dauduoiLoto")?>"><strong>TK đầu đuôi loto</strong></a></h2></li>
                <li><h2><a title="Thống kê chu kỳ loto" href="<?php echo Url::createUrl("statistic/chukyLoto")?>"><strong>TK chu kỳ loto</strong></a></h2></li>
            </ul>
        </div>

        <div class="box">
            <div class="pad5">
                <div class="box-note">
                    <p>Thống kê tần suất loto: Là thống kê số lần xuất hiện của 2 số cuối trong khoảng thời gian hoặc biên độ bạn lựa chọn xem.</p>

                </div>
            </div>
        </div>
        <?php 
            $code = isset($province["code"]) ? strtoupper($province["code"]):"";
            $this->renderPartial("application.views.statistic.box_sms",array("code"=>$code));
        ?>
        <div class="conect_out pad5">
            <?php $this->renderPartial("application.views.layouts.social");?>
        </div>
        <ul class="col-25-75 pad10-5">
            <li>
                <label class="in-block"><strong>Chọn tỉnh</strong></label>
                <div class="in-block">
                    <select name="province_id" onchange="window.location='<?php echo Url::createUrl("statistic/tansuatLoto")?>?province_id='+this.value">
                        <?php foreach($provinces as $value){ ?>
                            <option <?php echo $value["id"]==$search["province_id"] ? 'selected':''?> value="<?php echo $value["id"]?>"><?php echo $value["name"]?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
        </ul>
        <form method="POST">
            <ul class="col-25-75 pad10-5">
                <li>
                    <label class="in-block"><strong>Thời gian</strong></label>
                    <div class="in-block">
                        <p>
                            <input type="radio" name="type" value="0" <?php echo $search["type"]==0 ? 'checked':''?>> 
                            <strong>Từ </strong>
                            <input id="from_date" name="from_date" value="<?php echo $search["from_date"]?>" type="text" class="w25">
                            <strong>Đến </strong>
                            <input id="to_date" name="to_date" value="<?php echo $search["to_date"]?>" type="text" class="w25">
                        </p>
                        <p><input type="radio" name="type" value="1" <?php echo $search["type"]==1 ? 'checked':''?>> Xem theo biên độ ngày
                            <select name="times">
                                <option value="30" <?php echo $search["times"]==30 ? 'selected':''?>>30 lần mở thưởng gần đây</option>
                                <option value="60" <?php echo $search["times"]==60 ? 'selected':''?>>60 lần mở thưởng gần đây</option>
                                <option value="100" <?php echo $search["times"]==100 ? 'selected':''?>>100 lần mở thưởng gần đây</option>
                            </select>
                        </p>
                    </div>
                </li>
            </ul>
            <div class="bg_org clearfix pad10-5">
                <h2 class="fl">Chọn bộ số cần thống kê </h2>
                <div class="fr">
                    <span class="mag-r5"><input type="radio" value="1" onclick="check_all()">&nbsp;Chọn tất cả</span>
                    <span><input type="radio" value="1" onclick="uncheck_all()">&nbsp;Xóa tất cả</span>
                </div>
            </div>
            <ul class="list-bstk txt-center magb10">
                <?php 
                    for($i=0;$i<100;$i++){
                        $bs = $i <10 ? '0'.$i:$i;
                    ?>
                    <li class="in-block"><input type="checkbox" class="mag-r5" name="boso[]" value="<?php echo $bs?>" <?php echo in_array($bs,$boso) ? 'checked':''?>><strong class="clred"><?php echo $bs;?></strong></li>
                    <?php }?> 
            </ul>
            <div class="txt-center">
                <button class="bt-green" type="submit"><strong>Xem kết quả</strong></button>
            </div>
        </form>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_middle"); ?>
    <div class="box">
        <?php if($data){ $arr_boso = $boso ?>
            <div class="scoll">
                <h2 class="bg_red pad10-5">Kết quả thống kê tần suất loto <?php echo $province["name"]?>
                    <?php if($search["type"]==0){?>
                        từ <?php echo $search["from_date"]?> đến <?php echo $search["to_date"]?>
                        <?php }else{?>
                        <?php echo $search["times"]?> lần mở thưởng gần đây
                        <?php }?>
                </h2>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mag0">
                    <tr>
                        <th class="pad0"><div class="ic ic-img3"></div></th>
                        <?php foreach($arr_boso as $boso){ $total[$boso] = 0; ?>
                            <th><div class="w40"><?php echo $boso;?></div></th>
                            <?php }?>
                    </tr>
                    <?php foreach($data as $key=>$value){ ?>
                        <tr>             
                            <td class="s12" width="68"><div class="w68"><?php echo date('d-m-Y',strtotime($key))?></div></td>

                            <?php    
                                foreach($arr_boso as $boso){

                                    if(isset($value[$boso]) && $value[$boso]["tan_so"] >0){
                                        $total[$boso] = $value[$boso]["tan_so"] + $total[$boso];
                                    }
                                    $giai = "";
                                    if(isset($value[$boso])){
                                        $giai = 'bộ số  '.$boso.' về '.$value[$boso]["tan_so"].' lần ở các giải: ';

                                        $g = json_decode($value[$boso]["giai"],true);
                                        $giai .= implode(", ",$g);
                                    }
                                ?>
                                <td class="<?php echo (isset($value[$boso]) && $value[$boso]["tan_so"] >0) ? 'bg_note tt_boso' : ''?>" title="<?php echo rtrim($giai,", ")?>">
                                    <div class="w40"><?php echo (isset($value[$boso]) && $value[$boso]["tan_so"] >0) ? $value[$boso]["tan_so"] : ''?></div>
                                </td>
                                <?php }?>
                        </tr>
                        <?php }?>
                    <?php if(!empty($total)){?>
                        <tr>  
                            <td class="s12">Tổng số</td>
                            <?php foreach($total as $tong){?>
                                <td>
                                    <div class="w40"><?php echo $tong?></div>
                                </td>
                                <?php }?>
                        </tr>  
                        <?php }?>
                </table>
            </div>    
            <div class="fullscreen txt-center">
                <?php 
                    if(!empty($_POST["boso"])){
                        $link_full = Url::createUrl("statistic/tansuatLotoFull",array("province_id"=>$search["province_id"],"type"=>$search["type"],"from_date"=>$search["from_date"],"to_date"=>$search["to_date"],"times"=>$search["times"],"boso"=>$_POST["boso"]));
                    }else{
                        $link_full = Url::createUrl("statistic/tansuatLotoFull",array("province_id"=>$search["province_id"],"type"=>$search["type"],"from_date"=>$search["from_date"],"to_date"=>$search["to_date"],"times"=>$search["times"]));
                    }
                ?>
                <span class="bg_gray"><a rel="nofollow" class="ic ic-fulscren" title="" target="_blank" href="<?php echo $link_full;?>"><strong>Xem toàn trang</strong></a></span>
            </div> 
            <?php }?>

    </div>

    <div class="box pad10-5">
        <ul class="list-dot-red">
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-bac"))?>" title="Thống kê tần suất loto miền bắc">Thống kê tần suất loto miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-nam"))?>" title="Thống kê tần suất loto miền nam">Thống kê tần suất loto miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-trung"))?>" title="Thống kê tần suất loto miền trung">Thống kê tần suất loto miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
</div>