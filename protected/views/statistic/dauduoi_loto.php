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
        $( ".tt_dau_lt" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
        $( ".tt_duoi_lt" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
    });
</script>
<div class="col-l">
    <?php $this->renderPartial("application.views.module.adsense_top"); ?>
    <div class="box statis-loto">  
        <h1 class="title-bor mag0">
            <?php if(isset($_GET["province_id"])){?>
                <strong>Thống kê đầu đuôi loto <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê đầu đuôi loto <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê đầu đuôi loto</strong>
                <?php }?>
        </h1>  
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class="first">
                    <h2><a title="Thống kê tần suất loto" href="<?php echo Url::createUrl("statistic/tansuatLoto")?>"><strong>TK tần suất loto</strong></a></h2>
                </li>
                <li class="active"><h2><a title="Thống kê đầu đuôi loto" href="<?php echo Url::createUrl("statistic/dauduoiLoto")?>"><strong>TK đầu đuôi loto</strong></a></h2></li>
                <li><h2><a title="Thống kê chu kỳ loto" href="<?php echo Url::createUrl("statistic/chukyLoto")?>"><strong>TK chu kỳ loto</strong></a></h2></li>
            </ul>
        </div>
        <div class="box">

            <div class="pad5">
                <div class="box-note">
                    <p>- Tính năng này giúp bạn xem được thống kê đầu/đuôi loto của từng giải theo khoảng thời gian tùy chọn hoặc xem thống kê theo biên độ 30 lần, 60 lần và 100 lần mở thưởng gần đây nhất.</p>
                    <p>- Thống kê chi tiết số lần về của bộ số có đầu/đuôi, và bộ số bao nhiêu. (Mời di chuột vào từng số để xem chi tiết)</p>
                    <div class="interpreted">*Thống kê đầu đuôi loto: Thống kê đầu loto từ 0 – 9 hoặc đít loto 0 – 9 theo khoảng thời gian hoặc biên độ 30 lần, 60 lần, 100 lần mở thưởng gần đây mà bạn lựa chọn.</div>
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
        <form method="POST">
            <ul class="col-25-75 pad10-5">
                <li>
                    <label class="in-block"><strong>Chọn tỉnh</strong></label>
                    <div class="in-block">
                        <select name="province_id">
                            <?php foreach($provinces as $value){ ?>
                                <option <?php echo $value["id"]==$search["province_id"] ? 'selected':''?> value="<?php echo $value["id"]?>"><?php echo $value["name"]?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
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

                <li>
                    <label class="in-block"></label>
                    <div class="in-block">
                        <button class="bt-green"><strong>Xem kết quả</strong></button>
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_middle"); ?>
    <div class="box">
        <h2 class="bg_red pad10-5">
            Kết quả thống kê theo đầu loto <?php echo $province["name"]?>
            <?php if($search["type"]==0){?>
                từ <?php echo $search["from_date"]?> đến <?php echo $search["to_date"]?>
                <?php }else{?>
                <?php echo $search["times"]?> lần mở thưởng gần đây
                <?php }?>
        </h2>
        <div class="scoll">
            <table cellspacing="0" cellpadding="0" border="0" class="mag0" width="100%">
                <tr>
                    <th class="pad0"><div class="ic ic-img2"></div></th>
                    <th><div class="w40">0</div></th>
                    <th><div class="w40">1</div></th>
                    <th><div class="w40">2</div></th>
                    <th><div class="w40">3</div></th>
                    <th><div class="w40">4</div></th>
                    <th><div class="w40">5</div></th>
                    <th><div class="w40">6</div></th>
                    <th><div class="w40">7</div></th>
                    <th><div class="w40">8</div></th>
                    <th><div class="w40">9</div></th>
                </tr>
                <?php 
                    $total = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0);
                    foreach($dau as $key=>$value){   
                        //var_dump($value);die;
                    ?>
                    <tr>
                        <td width="68" class="s12"><div class="w68"><?php echo date('d-m-Y',strtotime($key))?></div></td>
                        <?php 
                            for($i=0;$i<=9;$i++){

                                $giai = "";
                                $lan = 0;
                                if(!empty($value[$i])){   
                                    $g = '';
                                    for($j=0;$j < count($value[$i]);$j++){
                                        $g .= $value[$i][$j]["boso"].' - giai: '. implode(", ",json_decode($value[$i][$j]["giai"],true)).' & ';
                                        $lan = $value[$i][$j]["tan_so"] + $lan;
                                    }
                                    $giai = 'đầu '.$i.' về '.$lan.' lần ở các bộ số: '.$g;
                                    $total[$i] = $lan + $total[$i];
                                    $giai = rtrim($giai," & ");
                                }
                            ?>
                            <td class="<?php echo (isset($value[$i]) && $lan >0) ? 'tt_dau_lt' : 'bg_note'?>" title="<?php echo rtrim($giai,", ");?>">
                                <div class="w40"><?php echo $lan?></div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
                <?php if($total){?>
                    <tr class="row-rate">
                        <td><strong>Tổng</strong></td>
                        <?php 
                            for($i=0;$i<=9;$i++){
                                if(isset($total[$i])){
                                    $tong = $total[$i];
                                }else{
                                    $tong = 0;
                                }
                            ?>
                            <td>
                                <strong><?php echo $tong?></strong>
                                <div class="rate txt-center">
                                    <span style="height:<?php echo $tong;?>px" class="hrate"></span>
                                </div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
            </table>

        </div>

        <h2 class="bg_red pad10-5">Kết quả thống kê theo đuôi loto <?php echo $province["name"]?>
            <?php if($search["type"]==0){?>
                từ <?php echo $search["from_date"]?> đến <?php echo $search["to_date"]?>
                <?php }else{?>
                <?php echo $search["times"]?> lần mở thưởng gần đây
                <?php }?>
        </h2>
        <div class="scoll">
            <table cellspacing="0" cellpadding="0" border="0" class="mag0" width="100%">
                <tr>
                    <th class="pad0"><div class="ic ic-img5"></div></th>
                    <th><div class="w40">0</div></th>
                    <th><div class="w40">1</div></th>
                    <th><div class="w40">2</div></th>
                    <th><div class="w40">3</div></th>
                    <th><div class="w40">4</div></th>
                    <th><div class="w40">5</div></th>
                    <th><div class="w40">6</div></th>
                    <th><div class="w40">7</div></th>
                    <th><div class="w40">8</div></th>
                    <th><div class="w40">9</div></th>
                </tr>
                <?php 
                    $total = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0);
                    foreach($duoi as $key=>$value){
                    ?>
                    <tr>
                        <td width="68" class="s12"><div class="w68"><?php echo date('d-m-Y',strtotime($key))?></div></td>
                        <?php 
                            for($i=0;$i<=9;$i++){
                                $giai = "";
                                $lan = 0;
                                if(!empty($value[$i])){   
                                    $g = '';
                                    for($j=0;$j < count($value[$i]);$j++){
                                        $g .= $value[$i][$j]["boso"].' - giai: '. implode(", ",json_decode($value[$i][$j]["giai"],true)).' & ';
                                        $lan = $value[$i][$j]["tan_so"] + $lan;
                                    }
                                    $giai = 'đuôi '.$i.' về '.$lan.' lần ở các bộ số: '.$g;
                                    $total[$i] = $lan + $total[$i];
                                    $giai = rtrim($giai," & ");
                                }
                            ?>
                            <td class="<?php echo (isset($value[$i]) && $lan >0) ? 'tt_duoi_lt' : 'bg_note'?>" title="<?php echo rtrim($giai,", ");?>">
                                <div class="w40"><?php echo $lan?></div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
                <?php if($total){?>
                    <tr class="row-rate">
                        <td><strong>Tổng</strong></td>
                        <?php 
                            for($i=0;$i<=9;$i++){
                                if(isset($total[$i])){
                                    $tong = $total[$i];
                                }else{
                                    $tong = 0;
                                }
                            ?>
                            <td>
                                <strong><?php echo $tong?></strong>
                                <div class="rate txt-center">
                                    <span style="height:<?php echo $tong;?>px" class="hrate"></span>
                                </div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
            </table>
        </div>
        <div class="fullscreen txt-center">
            <?php 
                $link_full = Url::createUrl("statistic/dauduoiLotoFull",array("province_id"=>$search["province_id"],"type"=>$search["type"],"from_date"=>$search["from_date"],"to_date"=>$search["to_date"],"times"=>$search["times"]));
            ?>
            <span class="bg_gray"><a rel="nofollow" class="ic ic-fulscren" title="" target="_blank" href="<?php echo $link_full;?>"><strong>Xem toàn trang</strong></a></span>
        </div>
    </div>

    <div class="box pad10-5">
        <ul class="list-dot-red">
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-bac"))?>" title="Thống kê đầu đuôi loto miền bắc">Thống kê đầu đuôi loto miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-nam"))?>" title="Thống kê đầu đuôi loto miền nam">Thống kê đầu đuôi loto miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/dauduoiLoto",array("region"=>"mien-trung"))?>" title="Thống kê đầu đuôi loto miền trung">Thống kê đầu đuôi loto miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
</div>