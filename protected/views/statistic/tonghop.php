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
    });
</script>
<div class="col-l">
    <?php $this->renderPartial("application.views.module.adsense_top"); ?>
    <div class="box statis-loto"> 
        <h1 class="title-bor mag0">
            <?php if(isset($_GET["province_id"])){?>
                <strong>Thống kê tổng hợp <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê tổng hợp <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê tổng hợp </strong>
                <?php }?>
        </h1>   
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class=" first">
                    <h2><a title="Thống kê nhanh" href="<?php echo Url::createUrl("statistic/nhanh")?>"><strong>Thống kê nhanh</strong></a></h2>
                </li>
                <li><h2><a title="Thống kê loto gan" href="<?php echo Url::createUrl("statistic/lotoGan")?>"><strong>Thống kê loto gan</strong></a></h2></li>
                <li class="active"><h2><a title="Thống kê tổng hợp" href="<?php echo Url::createUrl("statistic/tonghop")?>"><strong>Thống kê tổng hợp</strong></a></h2></li>
            </ul>
        </div>
        <div class="box">
            <div class="pad5">
                <div class="box-note">
                    <p>- Tính năng này giúp bạn thống kê tổng chẵn, tổng lẻ, bộ số lẻ, bộ số chẵn của từng tỉnh, miền theo khoảng thời gian bạn lựa chọn.</p>
                    <p>- Thống kê tổng chẵn: thống kê 2 số cuối có tổng là chẵn 2,4,6,8,0</p>
                    <p>- Thống kê tổng lẻ: Thống kê 2 số cuối có tổng là lẻ 1,3,5,7,9</p>
                    <div class="interpreted">* Thống kê tổng hợp: Thống kê tổng số lần xuất hiện, ngày về gần nhất và số ngày chưa về của tổng 2 số = chẵn hoặc lẻ trong khoảng thời gian mà bạn lựa</div>
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
                    <label class="in-block"><strong>Loại thống kê</strong></label>
                    <div class="in-block">
                        <select name="type">
                            <?php foreach(LoadConfig::$general_statitic as $key=>$value){ ?>
                                <option <?php echo $key==$search["type"] ? 'selected':''?> value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li>
                    <label class="in-block"><strong>Thời gian từ</strong></label>
                    <div class="in-block">
                        <input id="from_date" name="from_date" value="<?php echo $search["from_date"]?>" type="text" class="w2input">
                        <strong>Đến</strong> 
                        <input id="to_date" name="to_date" value="<?php echo $search["to_date"]?>" type="text" class="w2input">
                    </div>
                </li>
                <li>
                    <label class="in-block"><strong>Hiển thị</strong></label>
                    <div class="in-block">
                        <span class="percent-50"><input type="radio" name="is_dacbiet" value="0" <?php echo $search["is_dacbiet"]==0 ? 'checked':''?>> Tất cả các giải </span>
                        <span class="percent-50"><input type="radio" name="is_dacbiet" value="1" <?php echo $search["is_dacbiet"]==1 ? 'checked':''?>> Giải đặc biệt</span>
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
        <h2 class="bg_red pad10-5"><?php echo isset(LoadConfig::$general_statitic[$search["type"]]) ? LoadConfig::$general_statitic[$search["type"]]:"Thống kê tổng hợp"?>
            <?php echo $province["name"]?> từ <?php echo $search["from_date"]?> đến <?php echo $search["to_date"]?>
        </h2>
        <div class="scoll">
            <?php if($data){
                    if(!in_array($search["type"],array(9,10))){
                    ?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <th width="10%">Bộ số</th>
                            <th width="30%"><p class="mag0">Tổng số lần xuất hiện</th>
                            <th width="30%">Ngày về gần nhất</th>
                            <th width="30%">Số ngày chưa về</th>
                        </tr>
                        <?php foreach($data as $key=>$value){?>
                            <tr>
                                <td><strong class="clred s18"><?php echo $value["boso"];?></strong></td>
                                <td>
                                    <p class="mag0"><strong class="s18"><?php echo $value["length"]?></strong></p>
                                </td>

                                <td><?php echo $value["near_date"];?></td>
                                <td><strong class="s18"><?php echo $value["gan"]?></strong></td>
                            </tr>
                            <?php }?>
                    </table>
                    <?php }elseif($search["type"]==9){?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <th width="10%">Đầu</th>
                            <th width="30%"><p class="mag0">Tổng số lần xuất hiện</th>
                        </tr>
                        <?php foreach($data as $key=>$value){?>
                            <tr>
                                <td><strong class="clred s18"><?php echo $value["boso"];?></strong></td>
                                <td>
                                    <p class="mag0"><strong class="s18"><?php echo $value["length"]?></strong></p>
                                </td>
                            </tr>
                            <?php }?>
                    </table>
                    <?php }else{?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <th width="10%">Đuôi</th>
                            <th width="30%"><p class="mag0">Tổng số lần xuất hiện</th>
                        </tr>
                        <?php foreach($data as $key=>$value){?>
                            <tr>
                                <td><strong class="clred s18"><?php echo $value["boso"];?></strong></td>
                                <td>
                                    <p class="mag0"><strong class="s18"><?php echo $value["length"]?></strong></p>
                                </td>
                            </tr>
                            <?php }?>
                    </table>
                    <?php }?>
                <?php }else{?>
                <center><strong>Không tồn tại dữ liệu của bộ số này!</strong></center>
                <?php }?>
        </div>

    </div>

    <div class="box pad10-5">
        <ul class="list-dot-red">
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/tonghop",array("region"=>"mien-bac"))?>" title="Thống kê tổng hợp miền bắc">Thống kê tổng hợp miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/tonghop",array("region"=>"mien-nam"))?>" title="Thống kê tổng hợp miền nam">Thống kê tổng hợp miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/tonghop",array("region"=>"mien-trung"))?>" title="Thống kê tổng hợp miền trung">Thống kê tổng hợp miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
</div>