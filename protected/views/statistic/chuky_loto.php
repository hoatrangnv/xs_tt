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
        $( ".chuky_max" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
        $( ".chuky_lt" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
        $( ".chuky_gan" ).tooltip({
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
                <strong>Thống kê chu kỳ loto <?php echo $province["name"]?></strong>
                <?php }elseif(isset($_GET["region"])){?>
                <strong>Thống kê chu kỳ loto <?php echo isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : ""?></strong>
                <?php }else{?>
                <strong>Thống kê chu kỳ loto</strong>
                <?php }?>
        </h1>
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class="first">
                    <h2><a title="Thống kê tần suất loto" href="<?php echo Url::createUrl("statistic/tansuatLoto")?>"><strong>TK tần suất loto</strong></a></h2>
                </li>
                <li><h2><a title="Thống kê đầu đuôi loto" href="<?php echo Url::createUrl("statistic/dauduoiLoto")?>"><strong>TK đầu đuôi loto</strong></a></h2></li>
                <li class="active"><h2><a title="Thống kê chu kỳ loto" href="<?php echo Url::createUrl("statistic/chukyLoto")?>"><strong>TK chu kỳ loto</strong></a></h2></li>
            </ul>
        </div>
        <div class="box">
            <div class="pad5">
                <div class="box-note">
                    <p>- Tính năng này thống kê chu kỳ ra dài nhất, số ngày ra liên tiếp, ngày về gần đây và ngày gan (ngày chưa ra) của Bộ số bạn lựa chọn xem trong khoảng thời gian bất kỳ</p>
                    <p>- Ví dụ: Chọn tỉnh xem là miền bắc, bộ số 55 và 77, Chọn thời gian xem từ 13/8/2014 đến 13/9/2014 -> Bạn xem được thống kê chu kỳ loto của bộ số 55 và 77</p>  
                    <p>- Di chuột vào từng bộ số để xem chi tiết</p> 
                    <div class="interpreted">
                        * Là thống kê 1 hoặc nhiều bộ số theo tỉnh, miền trong khoảng thời gian bạn lựa chọn. Bạn có thể chọn nhiều bộ số để thống kê, Lưu ý: Các bộ số cách nhau bởi dấu “,” 
                        Lưu ý: Bạn có thể nhập nhiều bộ số (Tối đa 10 số, các bộ cách nhau bởi dấu ",". Vd: "23,55,58,96...")
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
                    <select name="province_id" onchange="window.location='<?php echo Url::createUrl("statistic/chukyLoto")?>?province_id='+this.value">
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
        <h2 class="bg_red pad10-5">Kết quả thống kê chu kỳ loto <?php echo $province["name"]?> từ <?php echo $search["from_date"]?> đến <?php echo $search["to_date"]?></h2>
        <div class="scoll">
            <?php if($data){?>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <th width="9%">Bộ số</th>
                        <th><p class="mag0">Chu kỳ ra dài nhất</p><em>(Tính theo số lần mở thưởng)</em></th>
                        <th>Số ngày về liên tiếp nhiều nhất</th>
                        <th>Ngày về gần đây</th>
                        <th width="10%">Số ngày gan</th>
                    </tr>
                    <?php foreach($data as $key=>$value){
                            $tootip_chuky_max = $key.' ra từ ngày '. $value["start_date"].' đến ngày '.$value["end_date"].' mời ra lại, cách nhau '.$value["length"].' lần mở thưởng';
                            $tootip_chuky_lt = $value["length_lt"]. ' ngày về liên tục';
                            $tootip_chuky_gan = $value["gan"]. ' lần mở thưởng chưa về tính đến lần về gần đây '. $value["near_date"];
                        ?>
                        <tr>
                            <td><strong class="clred s18"><?php echo $key;?></strong></td>
                            <td>

                                <?php if(intval($value["length"]) >=0){?>
                                    <p class="mag0">
                                        <a rel="nofollow" href="#" title="<?php echo $tootip_chuky_max?>" class="chuky_max">
                                            <strong class="s18"><?php echo $value["length"]?></strong>
                                        </a>
                                    </p>
                                    <em class="s12"><?php echo $value["start_date"];?> - <?php echo $value["end_date"];?></em>

                                    <?php }?>
                            </td>
                            <td>
                                <?php if(intval($value["length_lt"]) >=0){?>
                                    <p class="mag0">
                                        <a href="#" rel="nofollow" title="<?php echo $tootip_chuky_lt;?>" class="chuky_lt">
                                            <strong class="s18"><?php echo $value["length_lt"]?></strong>
                                        </a>
                                    </p>
                                    <em class="s12"><?php echo $value["start_lt"]?> - <?php echo $value["end_lt"]?></em>

                                    <?php }?>
                            </td> 
                            <td><?php echo $value["near_date"];?></td>
                            <td>
                                <a href="#" rel="nofollow" title="<?php echo $tootip_chuky_gan;?>" class="chuky_gan">
                                    <strong class="s18"><?php echo $value["gan"]?></strong>
                                </a>
                            </td>
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
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/chukyLoto",array("region"=>"mien-bac"))?>" title="Thống kê chu kỳ loto miền bắc">Thống kê chu kỳ loto miền bắc</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/chukyLoto",array("region"=>"mien-nam"))?>" title="Thống kê chu kỳ loto miền nam">Thống kê chu kỳ loto miền nam</a></li>
            <li><img width="6" height="6" src="<?php echo Yii::app()->params["static_url"]?>/images/bullet-red.png" alt="icon ve so"><a href="<?php echo Url::createUrl("statistic/chukyLoto",array("region"=>"mien-trung"))?>" title="Thống kê chu kỳ loto miền trung">Thống kê chu kỳ loto miền trung</a></li>
        </ul>
    </div>
    <?php $this->renderPartial("application.views.module.adsense_bottom"); ?>
</div>