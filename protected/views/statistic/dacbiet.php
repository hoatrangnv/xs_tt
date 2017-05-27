<script type="text/javascript">
    function disable_month(val){
        if(val==1){
            $('#search_month').attr('disabled','disabled');
        }else{
            $('#search_month').removeAttr('disabled');
        }
    }
</script>
<div class="col-l">
    <?php $this->renderPartial("application.views.module.adsense_top"); ?>
    <div class="box statis-loto">    
        <h1 class="title-bor mag0">
            <?php if(isset($_GET["province_id"])){?>
                <strong>Thống kê giải đặc biệt <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê giải đặc biệt <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê giải đặc biệt</strong>
                <?php }?>
        </h1>
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class="first active"><h2><a title="Thống kê giải đặc biệt" href="<?php echo Url::createUrl("statistic/dacbiet")?>"><strong>Thống kê giải đặc biệt</strong></a></h2></li>
                <li><h2><a title="Thống kê đầu đuôi đặc biệt" href="<?php echo Url::createUrl("statistic/dauduoiDacbiet")?>"><strong>Thống kê đầu đuôi đặc biệt</strong></a></h2></li>
            </ul>
        </div>
        <div class="box">
        
            <div class="pad5">
                <div class="box-note">
                    <p>- Tính năng này giúp bạn thống kê bộ số giải đặc biệt nhanh theo tuần, tháng, hoặc khoảng thời gian tùy chọn</p>
                    <p>- Xem kết quả thống kê 2 số cuối, đầu/đuôi giải đặc biệt, hoặc tổng của 2 số cuối giải đặc biệt</p>
                    <div class="interpreted">Thống kê giải đặc biệt: Thống kê các bộ số - 2 số cuối của giải đặc biệt, đầu, đuôi giải đặc biệt theo tuần, tháng của từng tỉnh bạn cần xem</div>
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
                    <label class="in-block"><strong>Tháng</strong></label>
                    <div class="in-block">

                        <select id="search_month" class="w2input" name="month">
                            <?php for($i=1;$i<=12;$i++){?>
                                <option <?php echo $i==$search["month"] ? 'selected':''?> value="<?php echo $i;?>">Tháng <?php echo $i;?></option>
                                <?php }?>
                        </select>
                        <strong>Năm</strong>
                        <select class="w2input" name="year">
                            <?php for($i=2000;$i<=2035;$i++){?>
                                <option <?php echo $i==$search["year"] ? 'selected':''?> value="<?php echo $i;?>">Năm <?php echo $i;?></option>
                                <?php }?>
                        </select>


                    </div>
                </li>
                <li>
                    <label class="in-block"><strong>Chọn kiểu thống kê:</strong></label>
                    <div class="in-block">
                        <span class="percent-50"><input <?php echo $search["type_tk"]==0 ? 'checked':''?> type="radio" name="type_tk" value="0" onchange="disable_month(0)"> Thống kê theo tuần</span>
                        <span class="percent-50"><input <?php echo $search["type_tk"]==1 ? 'checked':''?> type="radio" name="type_tk" value="1" onchange="disable_month(1)"> Thống kê theo tháng</span>
                    </div>
                </li>
                <li>
                    <label class="in-block"><strong>Chọn loại hiển thị:</strong></label>
                    <div class="in-block">
                        <span class="percent-20"><input <?php echo $search["type"]==0 ? 'checked':''?> type="radio" name="type" value="0" type="radio"> 2 số cuối</span>
                        <span class="percent-20"><input <?php echo $search["type"]==1 ? 'checked':''?> type="radio" name="type" value="1" type="radio"> Đầu</span>
                        <span class="percent-20"><input <?php echo $search["type"]==2 ? 'checked':''?> type="radio" name="type" value="2" type="radio"> Đuôi</span>
                        <span class="percent-20"><input <?php echo $search["type"]==3 ? 'checked':''?> type="radio" name="type" value="3" type="radio"> Tổng</span>
                    </div>
                </li>
                <li>
                    <label class="in-block"></label>
                    <div class="in-block">
                        <button class="bt-green" type="submit"><strong>Xem kết quả</strong></button>
                    </div>
                </li>
            </ul>
        </form>
    </div>
     <?php $this->renderPartial("application.views.module.adsense_middle"); ?>
    <div class="box">
        <h2 class="bg_red pad10-5">Kết quả thống kê giải đặc biệt <?php echo $province["name"]?> tháng <?php echo $search["month"]?> năm <?php echo $search["year"]?></h2>
        <div class="scoll">
            <?php 
                if($data){
                    if($search["type_tk"]==0){
                    ?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mag0">
                        <tr>
                            <th width="52" class="pad0 ic ic-img"></th>
                            <th class="pad0">Hai</th>
                            <th class="pad0">Ba</th>
                            <th class="pad0">Tư</th>
                            <th class="pad0">Năm</th>
                            <th class="pad0">Sáu</th>
                            <th class="pad0">Bảy</th>
                            <th width="13%" class="pad0">Chủ Nhật</th>
                        </tr>
                        <?php foreach($data as $key=>$value){
                                if($search["type"]==0){
                                    $field = "boso";
                                }elseif($search["type"]==1){
                                    $field = "dau_so";
                                }elseif($search["type"]==2){
                                    $field = "dit_so";
                                }else{
                                    $field = "tong_bo";
                                }
                            ?>
                            <tr>
                                <td><?php echo $key;?></td>
                                <td><strong class="clred"><?php echo isset($value["thu2"][$field]) ? $value["thu2"][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value["thu3"][$field]) ? $value["thu3"][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value["thu4"][$field]) ? $value["thu4"][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value["thu5"][$field]) ? $value["thu5"][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value["thu6"][$field]) ? $value["thu6"][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value["thu7"][$field]) ? $value["thu7"][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value["thu1"][$field]) ? $value["thu1"][$field]: "&nbsp;"?></strong></td>
                            </tr>
                            <?php }?>
                    </table>
                    <?php }else{?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mag0">
                        <tr>
                            <th width="52" class="pad0 ic ic-img4"></th>
                            <th class="pad0">01</th>
                            <th class="pad0">02</th>
                            <th class="pad0">03</th>
                            <th class="pad0">04</th>
                            <th class="pad0">05</th>
                            <th class="pad0">06</th>
                            <th class="pad0">07</th>
                            <th class="pad0">08</th>
                            <th class="pad0">09</th>
                            <th class="pad0">10</th>
                            <th class="pad0">11</th>
                            <th class="pad0">12</th>
                        </tr>
                        <?php foreach($data as $key=>$value){
                                if($search["type"]==0){
                                    $field = "boso";
                                }elseif($search["type"]==1){
                                    $field = "dau_so";
                                }elseif($search["type"]==2){
                                    $field = "dit_so";
                                }else{
                                    $field = "tong_bo";
                                }
                            ?>
                            <tr>
                                <td><?php echo $key;?></td>
                                <td><strong class="clred"><?php echo isset($value[1][$field]) ? $value[1][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[2][$field]) ? $value[2][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[3][$field]) ? $value[3][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[4][$field]) ? $value[4][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[5][$field]) ? $value[5][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[6][$field]) ? $value[6][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[7][$field]) ? $value[7][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[8][$field]) ? $value[8][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[9][$field]) ? $value[9][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[10][$field]) ? $value[10][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[11][$field]) ? $value[11][$field]: "&nbsp;"?></strong></td>
                                <td><strong class="clred"><?php echo isset($value[12][$field]) ? $value[12][$field]: "&nbsp;"?></strong></td>
                            </tr>
                            <?php }?>
                    </table>
                    <?php }
            }?>
        </div>
    </div>

    <div class="box pad10-5">
        <ul class="list-dot-red">
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/dacbiet",array("region"=>"mien-bac"))?>" title="Thống kê giải đặc biệt miền bắc">Thống kê giải đặc biệt miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/dacbiet",array("region"=>"mien-nam"))?>" title="Thống kê giải đặc biệt miền nam">Thống kê giải đặc biệt miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/dacbiet",array("region"=>"mien-trung"))?>" title="Thống kê giải đặc biệt miền trung">Thống kê giải đặc biệt miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
      </div>