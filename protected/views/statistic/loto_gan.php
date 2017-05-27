
<div class="col-l">
    <?php $this->renderPartial("application.views.module.adsense_top"); ?>
    <div class="box statis-loto">
        <h1 class="title-bor mag0">
            <?php if(isset($_GET["province_id"])){?>
                <strong>Thống kê loto gan <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê loto gan <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê loto gan </strong>
                <?php }?>
        </h1>
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class=" first">
                    <h2><a title="Thống kê nhanh" href="<?php echo Url::createUrl("statistic/nhanh")?>"><strong>Thống kê nhanh</strong></a></h2>
                </li>
                <li class="active"><h2><a title="Thống kê loto gan" href="<?php echo Url::createUrl("statistic/lotoGan")?>"><strong>Thống kê loto gan</strong></a></h2></li>
                <li><h2><a title="Thống kê tổng hợp" href="<?php echo Url::createUrl("statistic/tonghop")?>"><strong>Thống kê tổng hợp</strong></a></h2></li>
            </ul>
        </div>   
        <div class="box">
            <div class="pad5">
                <div class="box-note">
                    <p>- Tính năng này thống kê ngày ra, số ngày Gan của số biên độ Gan mà bạn lựa chọn (Ví dụ: chọn biên độ gan = 10 bạn sẽ xem được thống kê các bộ số chưa về trong 10 lần quay tính đến ngày mở thưởng hôm nay)</p>
                    <div class="interpreted">
                        <p>* Thống kê loto gan cho bạn biết: Bộ số loto chưa về trong những lần mở thưởng gần đây, bảng thống kê ngày gan cực đại của bộ số loto từ 00 đến 99 Số ngày gan tính theo số lần mở thưởng mà bộ số loto chưa về ( Tính đến ngày hôm nay)</p>
                    </div>

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
                    <select name="province_id" onchange="window.location='<?php echo Url::createUrl("statistic/lotoGan")?>?province_id='+this.value">
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
                    <label class="in-block"><strong>Chọn biên độ</strong></label>
                    <div class="in-block">
                        <input type="text" name="biendo" value="<?php echo $search["biendo"];?>"/><br/>
                        <em>(Số lần mở thưởng gần đây nhất ) </em>
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
    <?php if($search["biendo"] !=""){?>
        <div class="box">
            <h2 class="bg_red pad10-5">Thống kê loto gan <?php echo ($province["name"])?>
                <?php echo $search["biendo"];?> lần mở thưởng gần đây
            </h2>
            <div class="scoll">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mag0">
                    <tr>
                        <th>Bộ số</th>
                        <th>Ngày ra trước</th>
                        <th>Ngày ra gần đây</th>
                        <th>Số ngày gan</th>
                    </tr>
                    <?php foreach($data_gan as $value){    
                            $start_date = date('d-m-Y',strtotime($value["start_date"]));
                            $end_date = !empty($value["end_date"]) ? date('d-m-Y',strtotime($value["end_date"])) : "";

                        ?>
                        <tr>
                            <td><strong><?php echo $value["boso"]?></strong></td>
                            <td><?php echo $start_date;?></td>
                            <td><?php echo $end_date;?></td>
                            <td><strong class="s18 clred"><?php echo $value["length"] - 1;?></strong></td>
                        </tr>
                        <?php  }?>
                </table>
            </div>

        </div>
        <?php }?>

    <div class="box pad10-5">
        <ul class="list-dot-red">
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/lotoGan",array("region"=>"mien-bac"))?>" title="Thống kê loto gan miền bắc">Thống kê loto gan miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/lotoGan",array("region"=>"mien-nam"))?>" title="Thống kê loto gan miền nam">Thống kê loto gan miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/lotoGan",array("region"=>"mien-trung"))?>" title="Thống kê loto gan miền trung">Thống kê loto gan miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
</div>