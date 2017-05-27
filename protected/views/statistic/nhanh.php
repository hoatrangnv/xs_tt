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
                <strong>Thống kê nhanh <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê nhanh <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê nhanh </strong>
                <?php }?>
        </h1>
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class="active first">
                    <h2><a title="Thống kê nhanh" href="<?php echo Url::createUrl("statistic/nhanh")?>"><strong>Thống kê nhanh</strong></a></h2>
                </li>
                <li><h2><a title="Thống kê loto gan" href="<?php echo Url::createUrl("statistic/lotoGan")?>"><strong>Thống kê loto gan</strong></a></h2></li>
                <li><h2><a title="Thống kê tổng hợp" href="<?php echo Url::createUrl("statistic/tonghop")?>"><strong>Thống kê tổng hợp</strong></a></h2></li>
            </ul>
        </div>
        <div class="box">
            <div class="pad5">
                <div class="box-note">
                    <p>- Tính năng này giúp bạn thống kê nhanh 1 hay nhiều bộ số của từng tỉnh, miền theo khoảng thời gian bạn lựa chọn</p>
                    <p>- Thống kê nhanh bộ số của tất các giải theo khoảng thời gian tùy chọn</p>
                    <p>- Thống kê nhanh bộ số giải đặc biệt theo khoảng thời gian tùy chọn</p>
                    <div class="interpreted">* Thống kê nhanh: Thống kê tổng số lần xuất hiện, ngày về gần nhất và số ngày chưa về của bộ số bạn cần xem, theo tỉnh và khoảng thời gian bạn muốn xem</div>
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
                    <label class="in-block"><strong>Chọn số</strong></label>
                    <div class="in-block">
                        <input type="text" name="boso" value="<?php echo $boso;?>"/>
                        <em>(Bạn có thể thống kê nhiều bộ số bằng cách chèn dấu ',' giữa các bộ số)</em>
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
        <h2 class="bg_red pad10-5">Kết quả thống kê nhanh <?php echo $province["name"]?>
            từ <?php echo $search["from_date"]?> đến <?php echo $search["to_date"]?>
        </h2>
        <div class="scoll">
            <?php if($data){?>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <th width="10%">Bộ số</th>
                        <th width="30%"><p class="mag0">Tổng số lần xuất hiện</th>
                        <th width="30%">Ngày về gần nhất</th>
                        <th width="30%">Số ngày chưa về</th>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                            <td><strong class="clred s18"><?php echo $key;?></strong></td>
                            <td>
                                <p class="mag0"><strong class="s18"><?php echo $value["length"]?></strong></p>
                            </td>

                            <td><?php echo $value["near_date"];?></td>
                            <td><strong class="s18"><?php echo $value["gan"]?></strong></td>
                        </tr>
                        <?php }?>
                </table>
                <?php }else{?>
                <center><strong>Không tồn tại dữ liệu của bộ số này!</strong></center>
                <?php }?>
        </div>

    </div>

    <div class="box pad10-5">
        <ul class="list-dot-red">
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/nhanh",array("region"=>"mien-bac"))?>" title="Thống kê nhanh miền bắc">Thống kê nhanh miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/nhanh",array("region"=>"mien-nam"))?>" title="Thống kê nhanh miền nam">Thống kê nhanh miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/nhanh",array("region"=>"mien-trung"))?>" title="Thống kê nhanh miền trung">Thống kê nhanh miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
</div>